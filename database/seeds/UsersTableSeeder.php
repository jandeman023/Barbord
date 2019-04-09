<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'nickname' => 'Johan P',
                'group_id' => 1,
                'full_name' => 'Johan pieterson',
                'balance' => 6738,
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('secret'),
            ],
            [
                'nickname' => 'Egbert G',
                'group_id' => 1,
                'full_name' => 'Egbert Groot',
                'balance' => 4823,
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('secret'),
            ],
            [
                'nickname' => 'Lotte H',
                'group_id' => 1,
                'full_name' => 'Lotte Hilson',
                'balance' => 5728,
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('secret'),
            ],
            [
                'nickname' => 'michel W',
                'group_id' => 1,
                'full_name' => 'Michel Wit',
                'balance' => 1369,
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('secret'),
            ],
        ]);

        DB::table('orders')->insert(['id' => 0]);

        DB::table('order_users')->insert([
            [
                'order_id' => 1,
                'user_id' => 1,
                'old_balance' => 0,
                'new_balance' => 1234,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'order_id' => 1,
                'user_id' => 2,
                'old_balance' => 0,
                'new_balance' => 5732,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'order_id' => 1,
                'user_id' => 3,
                'old_balance' => 0,
                'new_balance' => 1863,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'order_id' => 1,
                'user_id' => 4,
                'old_balance' => 0,
                'new_balance' => 8436,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);

        DB::table('order_users')->insert([
            [
                'order_id' => 1,
                'user_id' => 1,
                'old_balance' => 1234,
                'new_balance' => 6384,
                'created_at' => Carbon::tomorrow()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::tomorrow()->format('Y-m-d H:i:s'),
            ]
        ]);
    }
}
