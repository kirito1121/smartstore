<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        // $business = [
        //     ['name'=>'Do Uong'],
        // ];

        // DB::table('type_of_businesses')->insert($business);

        $brands = [
            ['name' => 'HaiLan'],
        ];

        DB::table('brands')->insert($brands);
        $units = [
            ['name' => 'ly'],
            ['name' => 'to'],
            ['name' => 'cai'],
            ['name' => 'suat'],
        ];

        DB::table('units')->insert($units);
        $stores = [
            ['name' => 'HaiLan 01', 'brand_id' => 1],
            ['name' => 'HaiLan 02', 'brand_id' => 1],
            ['name' => 'HaiLan 03', 'brand_id' => 1],
        ];

        DB::table('stores')->insert($stores);

        $type_services = [
            ['name' => 'Do uong', 'parent_id' => null, 'brand_id' => 1],
            ['name' => 'Do an', 'parent_id' => null, 'brand_id' => 1],
            ['name' => 'Cafe', 'parent_id' => 1, 'brand_id' => 1],
            ['name' => 'Tra Sua', 'parent_id' => 1, 'brand_id' => 1],
            ['name' => 'Banh', 'parent_id' => 2, 'brand_id' => 1],
            ['name' => 'My Tom', 'parent_id' => 2, 'brand_id' => 1],
            ['name' => 'Combo', 'parent_id' => null, 'brand_id' => 1],
        ];

        DB::table('service_groups')->insert($type_services);

        $services = [
            ['name' => 'Cafe den', 'price' => 10, 'service_group_id' => 3, 'brand_id' => 1, 'unit_id' => 1],
            ['name' => 'Cafe sua', 'price' => 12, 'service_group_id' => 3, 'brand_id' => 1, 'unit_id' => 1],
            ['name' => 'Tra Trang', 'price' => 15, 'service_group_id' => 4, 'brand_id' => 1, 'unit_id' => 1],
            ['name' => 'Tra Den', 'price' => 10, 'service_group_id' => 4, 'brand_id' => 1, 'unit_id' => 1],
            ['name' => 'Banh My', 'price' => 10, 'service_group_id' => 5, 'brand_id' => 1, 'unit_id' => 3],
            ['name' => 'Hamberger', 'price' => 12, 'service_group_id' => 5, 'brand_id' => 1, 'unit_id' => 3],
            ['name' => 'Hao Hao', 'price' => 15, 'service_group_id' => 6, 'brand_id' => 1, 'unit_id' => 2],
            ['name' => 'Omachi', 'price' => 10, 'service_group_id' => 6, 'brand_id' => 1, 'unit_id' => 2],
        ];
        DB::table('services')->insert($services);
        $combos = [
            ['name' => 'Combo 1', 'price' => 10, 'service_group_id' => 7, 'brand_id' => 1, 'unit_id' => 4],
            ['name' => 'Combo 2', 'price' => 12, 'service_group_id' => 7, 'brand_id' => 1, 'unit_id' => 4],
            ['name' => 'Combo 3', 'price' => 15, 'service_group_id' => 7, 'brand_id' => 1, 'unit_id' => 4],
            ['name' => 'Combo 4', 'price' => 10, 'service_group_id' => 7, 'brand_id' => 1, 'unit_id' => 4],
        ];
        DB::table('combos')->insert($combos);

        $comboHasService = [
            [
                'combo_id' => 1, 'service_id' => 1, 'quantity_service' => 1,
                'extras' =>
                json_encode([
                    [
                        'name' => 'size',
                        'value' => 'L',
                    ],
                    [
                        'name' => 'topping',
                        'value' => 'Thach',
                    ],
                ]),
            ],
            ['combo_id' => 1, 'service_id' => 7, 'quantity_service' => 1,
                'extras' =>
                json_encode([
                    [
                        'name' => 'size',
                        'value' => 'M',
                    ],
                ]),
            ],
            ['combo_id' => 2, 'service_id' => 4, 'quantity_service' => 1,
                'extras' =>
                json_encode([
                    [
                        'name' => 'size',
                        'value' => 'L',
                    ],
                    [
                        'name' => 'topping',
                        'value' => 'Chanh',
                    ],
                ]),
            ],
            ['combo_id' => 2, 'service_id' => 8, 'quantity_service' => 1,
                'extras' =>
                json_encode([
                    [
                        'name' => 'size',
                        'value' => 'L',
                    ],
                ]),
            ],
            ['combo_id' => 3, 'service_id' => 3, 'quantity_service' => 1,
                'extras' =>
                json_encode([
                    [
                        'name' => 'size',
                        'value' => 'M',
                    ],
                    [
                        'name' => 'topping',
                        'value' => 'Tran Chau',
                    ],
                ]),
            ],
            ['combo_id' => 3, 'service_id' => 6, 'quantity_service' => 1,
                'extras' =>
                json_encode([
                    [
                        'name' => 'size',
                        'value' => 'L',
                    ],
                ]),
            ],
            ['combo_id' => 4, 'service_id' => 2, 'quantity_service' => 1,
                'extras' =>
                json_encode([
                    [
                        'name' => 'size',
                        'value' => 'M',
                    ],
                    [
                        'name' => 'topping',
                        'value' => 'Dao',
                    ],
                ]),
            ],
            ['combo_id' => 4, 'service_id' => 5, 'quantity_service' => 1, 'extras' =>
                json_encode([
                    [
                        'name' => 'size',
                        'value' => 'L',
                    ],
                ]),
            ],
        ];
        DB::table('combo_has_services')->insert($comboHasService);

        $extras = [
            ['name' => 'size', 'brand_id' => 1],
            ['name' => 'toppin', 'brand_id' => 1],
        ];
        DB::table('extras')->insert($extras);
        $extra_options = [
            ['name' => 'M', 'extra_id' => 1],
            ['name' => 'L', 'extra_id' => 1],
            ['name' => 'Tran Chau', 'extra_id' => 2],
            ['name' => 'Thach', 'extra_id' => 2],
            ['name' => 'Chanh', 'extra_id' => 2],
            ['name' => 'Dao', 'extra_id' => 2],
        ];
        DB::table('extra_options')->insert($extra_options);

        $bonus = [
            ['value' => 'M', 'price' => 0, 'extra_id' => 1, 'service_id' => 1, 'default' => true],
            ['value' => 'L', 'price' => 10, 'extra_id' => 1, 'service_id' => 1, 'default' => false],
            ['value' => 'M', 'price' => 0, 'extra_id' => 1, 'service_id' => 2, 'default' => true],
            ['value' => 'L', 'price' => 10, 'extra_id' => 1, 'service_id' => 2, 'default' => false],
            ['value' => 'M', 'price' => 0, 'extra_id' => 1, 'service_id' => 3, 'default' => true],
            ['value' => 'L', 'price' => 10, 'extra_id' => 1, 'service_id' => 3, 'default' => false],
            ['value' => 'M', 'price' => 0, 'extra_id' => 1, 'service_id' => 4, 'default' => true],
            ['value' => 'L', 'price' => 10, 'extra_id' => 1, 'service_id' => 4, 'default' => false],

            ['value' => 'Tran Chau', 'price' => 10, 'extra_id' => 2, 'service_id' => 3, 'default' => false],
            ['value' => 'Thach', 'price' => 10, 'extra_id' => 2, 'service_id' => 3, 'default' => false],
            ['value' => 'Chanh', 'price' => 10, 'extra_id' => 2, 'service_id' => 3, 'default' => false],
            ['value' => 'Dao', 'price' => 10, 'extra_id' => 2, 'service_id' => 3, 'default' => false],
            ['value' => 'Tran Chau', 'price' => 10, 'extra_id' => 2, 'service_id' => 4, 'default' => false],
            ['value' => 'Thach', 'price' => 10, 'extra_id' => 2, 'service_id' => 4, 'default' => false],
            ['value' => 'Chanh', 'price' => 10, 'extra_id' => 2, 'service_id' => 4, 'default' => false],
            ['value' => 'Dao', 'price' => 10, 'extra_id' => 2, 'service_id' => 4, 'default' => false],

        ];
        DB::table('service_options')->insert($bonus);

        $specials = [
            ['service_id' => 1, 'start_date' => "2018-12-05", 'expiry_date' => "2018-12-07", 'price' => 3000, 'store_id' => 3, 'day_of_week' => json_encode(["day" => [1,2,3]])],
            ['service_id' => 3, 'start_date' => "2018-12-05", 'expiry_date' => "2018-12-07", 'price' => 4, 'store_id' => 3, 'day_of_week' =>  json_encode(["day" => [1,2,3]])],
            ['service_id' => 5, 'start_date' => "2018-12-05", 'expiry_date' => "2018-12-07", 'price' => 155, 'store_id' => 3, 'day_of_week' =>  json_encode(["day" => [1,2,3]])],
        ];
        DB::table('service_specials')->insert($specials);

        $users = [
            ['name' => 'A', 'email' => "A@gmail.com",'password' => 'admin' ],
            ['name' => 'B', 'email' => "BA@gmail.com",'password' => 'admin' ],
            ['name' => 'C', 'email' => "C@gmail.com", 'password' => 'admin'],
            ['name' => 'D', 'email' => "D@gmail.com", 'password' => 'admin'],
        ];
        DB::table('users')->insert($users);
        $staffs = [
            ['name' => 'E', 'email' => "E@gmail.com"],
            ['name' => 'F', 'email' => "FA@gmail.com"],
            ['name' => 'G', 'email' => "G@gmail.com"],
            ['name' => 'H', 'email' => "H@gmail.com"],
        ];
        DB::table('staffs')->insert($staffs);

        $favorites = [
            ['user_id' => 1, 'favoriteable_id' => 1,'favoriteable_type' => "service" ],
            ['user_id' => 1, 'favoriteable_id' => 2,'favoriteable_type' => "service" ],
            ['user_id' => 1, 'favoriteable_id' => 3,'favoriteable_type' => "service" ],
            ['user_id' => 1, 'favoriteable_id' => 4,'favoriteable_type' => "service" ],
            ['user_id' => 1, 'favoriteable_id' => 5,'favoriteable_type' => "service" ],

            ['user_id' => 2, 'favoriteable_id' => 1,'favoriteable_type' => "service" ],
            ['user_id' => 2, 'favoriteable_id' => 2,'favoriteable_type' => "service" ],
            ['user_id' => 2, 'favoriteable_id' => 3,'favoriteable_type' => "service" ],
            ['user_id' => 2, 'favoriteable_id' => 4,'favoriteable_type' => "service" ],
            ['user_id' => 2, 'favoriteable_id' => 5,'favoriteable_type' => "service" ],

            ['user_id' => 3, 'favoriteable_id' => 1,'favoriteable_type' => "service" ],
            ['user_id' => 3, 'favoriteable_id' => 2,'favoriteable_type' => "service" ],
            ['user_id' => 3, 'favoriteable_id' => 3,'favoriteable_type' => "service" ],
            ['user_id' => 3, 'favoriteable_id' => 4,'favoriteable_type' => "service" ],
            ['user_id' => 3, 'favoriteable_id' => 5,'favoriteable_type' => "service" ],
        ];
        DB::table('favorites')->insert($favorites);

        $orders = [
            ['no' => 'NN001', 'total' => 30, 'status' => 'done', 'store_id' => 1, 'staff_id' => 1,'user_id' => 1],
            ['no' => 'NN002', 'total' => 43, 'status' => 'done', 'store_id' => 1, 'staff_id' => 1,'user_id' => 1],
            ['no' => 'NN003', 'total' => 56, 'status' => 'done', 'store_id' => 1, 'staff_id' => 1,'user_id' => 1],
            ['no' => 'NN004', 'total' => 42, 'status' => 'done', 'store_id' => 1, 'staff_id' => 1,'user_id' => 1],
        ];
        DB::table('orders')->insert($orders);

        $order_details = [
            ['order_id' => 1, 'service_id' => 1, 'quantity' => 1, 'status' => 'done', 'note' => 1,'price'=>10],
            ['order_id' => 1, 'service_id' => 2, 'quantity' => 1, 'status' => 'done', 'note' => 1,'price'=>10],
            ['order_id' => 1, 'service_id' => 3, 'quantity' => 1, 'status' => 'done', 'note' => 1,'price'=>10],
            ['order_id' => 1, 'service_id' => 4, 'quantity' => 1, 'status' => 'done', 'note' => 1,'price'=>10],

            ['order_id' => 2, 'service_id' => 1, 'quantity' => 1, 'status' => 'done', 'note' => 1,'price'=>10],
            ['order_id' => 2, 'service_id' => 2, 'quantity' => 1, 'status' => 'done', 'note' => 1,'price'=>10],
            ['order_id' => 2, 'service_id' => 3, 'quantity' => 1, 'status' => 'done', 'note' => 1,'price'=>10],
            ['order_id' => 2, 'service_id' => 4, 'quantity' => 1, 'status' => 'done', 'note' => 1,'price'=>10],

            ['order_id' => 3, 'service_id' => 3, 'quantity' => 1, 'status' => 'done', 'note' => 1,'price'=>10],
            ['order_id' => 3, 'service_id' => 4, 'quantity' => 1, 'status' => 'done', 'note' => 1,'price'=>10],
            ['order_id' => 3, 'service_id' => 5, 'quantity' => 1, 'status' => 'done', 'note' => 1,'price'=>10],
            ['order_id' => 3, 'service_id' => 6, 'quantity' => 1, 'status' => 'done', 'note' => 1,'price'=>10],

            ['order_id' => 4, 'service_id' => 1, 'quantity' => 1, 'status' => 'done', 'note' => 1,'price'=>10],
            ['order_id' => 4, 'service_id' => 3, 'quantity' => 1, 'status' => 'done', 'note' => 1,'price'=>10],
            ['order_id' => 4, 'service_id' => 5, 'quantity' => 1, 'status' => 'done', 'note' => 1,'price'=>10],
            ['order_id' => 4, 'service_id' => 6, 'quantity' => 1, 'status' => 'done', 'note' => 1,'price'=>10],
        ];
        DB::table('order_details')->insert($order_details);

        $bills = [
            ['order_id' => 1, 'amount' => 30, 'date_to_out' => now()->toDateTimeString(), 'date_to_join' => now()->toDateTimeString(), 'staff_id' => 1,'user_id' => 1],
            ['order_id' => 2, 'amount' => 43, 'date_to_out' => now()->toDateTimeString(), 'date_to_join' => now()->toDateTimeString(), 'staff_id' => 1,'user_id' => 1],
            ['order_id' => 3, 'amount' => 56, 'date_to_out' => now()->toDateTimeString(), 'date_to_join' => now()->toDateTimeString(), 'staff_id' => 1,'user_id' => 1],
            ['order_id' => 4, 'amount' => 42, 'date_to_out' => now()->toDateTimeString(), 'date_to_join' => now()->toDateTimeString(), 'staff_id' => 1,'user_id' => 1],
        ];
        DB::table('bills')->insert($bills);

    }
}
