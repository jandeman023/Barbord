<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Hertog Jan',
                'price' => 70,
                'alcoholic' => 1,
            ],
            [
                'name' => 'Grolsch',
                'price' => 70,
                'alcoholic' => 1,
            ],
            [
                'name' => 'Snicker',
                'price' => 120,
                'alcoholic' => 0,
            ],
            [
                'name' => 'Paprika chips',
                'price' => 80,
                'alcoholic' => 0,
            ]
        ]);
    }
}
