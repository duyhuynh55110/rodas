<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // not add records if already insert before
        if (DB::table('countries')->count() > 1) {
            return;
        }

        $data = [
            [
                'id' => 1,
                'name' => 'United States',
                'calling_code' => '+1',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'VietNam',
                'calling_code' => '+84',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // insert data
        DB::table('countries')->insert($data);
    }
}
