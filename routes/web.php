<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
use App\Combo;
use App\Extra;
use App\ServiceGroup;

Route::get('/services', function () {

    $store_id = request()->store;
    $brand_id = request()->brand;
    $now = now();
    // return now();
    $services = ServiceGroup::with(['children' => function ($query) use ($store_id, $now) {
        $query->with(['services' => function ($qr) use ($store_id, $now) {
            $qr->withCount('favorites')->with([
                'unit',
                'serviceSpecial' => function ($q) use ($store_id, $now) {
                    $q->where('active',true)->where('store_id',$store_id)->whereDate('start_date', '<=', $now->toDateString())->whereDate('expiry_date', '>=', $now->toDateString())
                    ->whereJsonContains('day_of_week->day',$now->dayOfWeek)
                    ->orWhere([['start_date',null],["expiry_date",null]])->whereJsonContains('day_of_week->day',$now->dayOfWeek)
                    ->orWhere([['start_date',null],["expiry_date",null],['day_of_week',null]]);
                },
            ])->whereAll(true)->whereDoesntHave('storeOptions', function ($q) use ($store_id) {
                $q->where('store_id', $store_id)->whereAction(false);
            })->orWhere('all', false)->whereHas('storeOptions', function ($q) use ($store_id) {
                $q->where('store_id', $store_id)->whereAction(true);
            })->orDoesntHave('storeOptions');
        }]);
    }])->whereNull('parent_id')->where('brand_id', $brand_id)->get();

    $services_hot = ServiceGroup::with(['services' => function ($qr) use ($store_id, $now) {
            $qr->with([
                'unit',
                'serviceSpecial' => function ($q) use ($store_id, $now) {
                    $q->where('active',true)->where('store_id',$store_id)->whereDate('start_date', '<=', $now->toDateString())->whereDate('expiry_date', '>=', $now->toDateString())
                    ->whereJsonContains('day_of_week->day',$now->dayOfWeek)
                    ->orWhere([['start_date',null],["expiry_date",null]])->whereJsonContains('day_of_week->day',$now->dayOfWeek)
                    ->orWhere([['start_date',null],["expiry_date",null],['day_of_week',null]]);
                },
            ])->whereAll(true)->where('hot',true)->whereDoesntHave('storeOptions', function ($q) use ($store_id) {
                $q->where('store_id', $store_id)->whereAction(false);
            })->orWhere('all', false)->where('hot',true)->whereHas('storeOptions', function ($q) use ($store_id) {
                $q->where('store_id', $store_id)->whereAction(true);
            })->orDoesntHave('storeOptions')->where('hot',true);
    }])->whereHas('services', function ($service){
        $service->where('hot',true);
    })->whereNotNull('parent_id')->where('brand_id', $brand_id)->get();

    return response()->json([
        'services' => $services,
        'hot' => $services_hot,
    ]);

});

Route::get('services/extras/{id}', function ($id) {
    $store_id = request()->store;
    // $brand_id = request()->brand;
    $extras = Extra::with(['serviceOptions' => function ($query) use ($id, $store_id) {
        $query->where('service_id', $id)->whereDoesntHave('storeOptions', function ($qr) use ($store_id) {
            $qr->where('store_id', $store_id)->whereAction(false);
        });
    }])->whereHas('serviceOptions', function ($query) use ($id) {
        $query->where('service_id', $id);
    })->whereDoesntHave('storeOptions', function ($query) use ($store_id) {
        $query->where('store_id', $store_id)->whereAction(false);
    })->where('brand_id', 1)->get();
    return $extras;

});

Route::get('service_groups', function () {
    $store_id = request()->store;
    $services_groups = ServiceGroup::with(['children' => function ($query) {
        $query->withCount('services');
    }])->whereNull('parent_id')->where('brand_id', 1)->get();

    return $services_groups;
});

Route::get('extras', function () {
    $store_id = request()->store;
    $extras = Extra::with('extraOptions')
        ->whereDoesntHave('storeOptions', function ($query) use ($store_id) {
            $query->where('store_id', $store_id)->whereAction(false);
        })->where('brand_id', 1)->get();
    return $extras;
});


