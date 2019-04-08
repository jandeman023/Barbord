<?php

use Illuminate\Database\Seeder;

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
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('secret'),
            ],
            [
                'nickname' => 'Egbert G',
                'group_id' => 1,
                'full_name' => 'Egbert Groot',
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('secret'),
            ],
            [
                'nickname' => 'Lotte H',
                'group_id' => 1,
                'full_name' => 'Lotte Hilson',
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('secret'),
            ],
            [
                'nickname' => 'michel W',
                'group_id' => 1,
                'full_name' => 'Michel Wit',
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('secret'),
            ],
        ]);
    }
}
