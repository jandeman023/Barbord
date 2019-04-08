<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            [
                'name' => 'Explos',
                'alcohol_restriction' => true,
            ],
            [
                'name' => 'Rovers',
                'alcohol_restriction' => false,
            ],
            [
                'name' => 'Stam',
                'alcohol_restriction' => false,
            ]
        ]);
    }
}
