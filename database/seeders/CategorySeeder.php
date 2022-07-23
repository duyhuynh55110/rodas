<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Fruits',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Vegetables',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mushroom',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dairy',
                'created_by' => 1,
                'created__at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Oats',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bread',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now(),
            ],
        ];

        // insert data to categories table
        DB::table('categories')->insert($data);
    }
}
