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
use App\Extra;
use App\Order;
use App\ServiceGroup;
use App\User;
// use App\User;

Route::get('/services', function () {

    $store_id = request()->store;
    $brand_id = request()->brand;
    $now = now();
    // return now();
    $services = ServiceGroup::with(['children' => function ($query) use ($store_id, $now) {
        $query->with(['services' => function ($qr) use ($store_id, $now) {
            $qr->withCount(['favorites', 'orderDetails'])->with([
                'unit',
                'serviceSpecial' => function ($q) use ($store_id, $now) {
                    $q->where('active', true)->where('store_id', $store_id)->whereDate('start_date', '<=', $now->toDateString())->whereDate('expiry_date', '>=', $now->toDateString())
                        ->whereJsonContains('day_of_week->day', $now->dayOfWeekIso)
                        ->orWhere([['start_date', null], ["expiry_date", null]])->whereJsonContains('day_of_week->day', $now->dayOfWeekIso)->where('active', true)->where('store_id', $store_id)
                        ->orWhere([['start_date', null], ["expiry_date", null], ['day_of_week', null]])->where('active', true)->where('store_id', $store_id);
                },
            ])->whereAll(true)->whereDoesntHave('storeOptions', function ($q) use ($store_id) {
                $q->where('store_id', $store_id)->whereAction(false);
            })->orWhere('all', false)->whereHas('storeOptions', function ($q) use ($store_id) {
                $q->where('store_id', $store_id)->whereAction(true);
            })->orDoesntHave('storeOptions');
        }]);
    }])->whereNull('parent_id')->where('brand_id', $brand_id)->get();

    // $services_hot = ServiceGroup::with(['services' => function ($qr) use ($store_id, $now) {
    //     $qr->with([
    //         'unit',
    //         'serviceSpecial' => function ($q) use ($store_id, $now) {
    //             $q->where('active', true)->where('store_id', $store_id)->whereDate('start_date', '<=', $now->toDateString())->whereDate('expiry_date', '>=', $now->toDateString())
    //                 ->whereJsonContains('day_of_week->day', $now->dayOfWeek)
    //                 ->orWhere([['start_date', null], ["expiry_date", null]])->whereJsonContains('day_of_week->day', $now->dayOfWeek)
    //                 ->orWhere([['start_date', null], ["expiry_date", null], ['day_of_week', null]]);
    //         },
    //     ])->whereAll(true)->where('hot', true)->whereDoesntHave('storeOptions', function ($q) use ($store_id) {
    //         $q->where('store_id', $store_id)->whereAction(false);
    //     })->orWhere('all', false)->where('hot', true)->whereHas('storeOptions', function ($q) use ($store_id) {
    //         $q->where('store_id', $store_id)->whereAction(true);
    //     })->orDoesntHave('storeOptions')->where('hot', true);
    // }])->whereHas('services', function ($service) {
    //     $service->where('hot', true);
    // })->whereNotNull('parent_id')->where('brand_id', $brand_id)->get();

    return response()->json([
        'services' => $services,
        // 'hot' => $services_hot,
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

//-----------------------------------------------------------------------------------------------------------------------
//---------------------------Order----------------------- theo truong hop order - bill 1-1----------------------------------------------------------------

// ------------ customer -------

Route::get('customer/orders', function () {
    $user_id = request()->user_id;
    $user = User::with('orders')->find($user_id);
    return $user;
});

Route::get('customer/orders/{id}', function ($id) {
    $user_id = request()->user_id;
    $order = Order::with([
        'orderDetails',
        'bill',
        'children' => function ($children) {
            $children->with(['bill' => function ($bill) {
                $bill->with(['user', 'orderDetails']);
            }]);
        },
        'parent' => function ($parent) {
            $parent->with(['bill' => function ($bill) {
                $bill->with(['user', 'orderDetails']);
            }]);
        },
    ])->where('id', $id)->get();
    return $order;
});

// ------------ customer end -------

// ------------ manager -------

Route::get('manager/orders', function () {
    $store_id = request()->store_id;
    $order = Order::where('store_id', $store_id)->get();
    return $order;
});

Route::get('manager/orders/{id}', function ($id) {
    $store_id = request()->store_id;
    $order = Order::with([
        'orderDetails',
        'bill',
        'children' => function ($children) {
            $children->with(['bill' => function ($bill) {
                $bill->with(['user', 'orderDetails']);
            }]);
        },
        'parent' => function ($parent) {
            $parent->with(['bill' => function ($bill) {
                $bill->with(['user', 'orderDetails']);
            }]);
        },
    ])->where('id', $id)->where('store_id', $store_id)->get();
    return $order;
});

// ------------ manager end -------

//-----------------------------------------------------------------------------------------------------------------------
//---------------------------Order----------------------- theo truong hop order - bill 1-n----------------------------------------------------------------

// customer
Route::get('customer/ordersv2', function () {
    $user_id = request()->user_id;

    $order = Order::whereHas('bills', function ($bill) use ($user_id) {
        $bill->where('user_id', $user_id);
    })->orWhere('user_id', $user_id)->get();

    return $order;
});

Route::get('customer/ordersv2/{id}', function ($id) {
    $user_id = request()->user_id;
    $order = Order::with([
        'bills' => function ($bill) use ($user_id) {
            $bill->with(['user',
                'orderDetails' => function ($detail) {
                    $detail->with('extras');
                },
            ])->where('user_id', $user_id);
        },
    ])->where('id', $id)->get();
    return $order;
});
// customer end

// manager

Route::get('manager/ordersv2', function () {
    $store_id = request()->store_id;
    $order = Order::where('store_id', $store_id)->get();
    return $order;
});

Route::get('manager/ordersv2/{id}', function ($id) {
    $order = Order::with([
        'bills' => function ($bill) {
            $bill->with(['user', 'orderDetails']);
        },
    ])->where('id', $id)->get();
    return $order;
});

// manager emd
