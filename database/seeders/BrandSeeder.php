<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
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
                'name' => 'Avocados',
                'logo_file_name' => 'YRieU7o7N4UlxLJ21Adh5Ur4amrYU6o94uxxHrRI.png',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bare Fruits',
                'logo_file_name' => 'k6mzHTLZ1Ksr8I9T7xexKdmfYYM0qTdkwpIKepz6.jpg',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Fresh Fruits',
                'logo_file_name' => 'eDl7l81wYgulLWHbB1MKcaj3Wa7AMdXdOv5hW4xm.jpg',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'The Juice Alchemist',
                'logo_file_name' => 'EyCIyKxiu4YmmcVedUeiDLoR0Au6sjOfzP4ZvWX9.png',
                'created_by' => 1,
                'created__at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'La Bella Rocca',
                'logo_file_name' => 'ksJCz2sLJsOmdBsrwH3eKKKhEqGFypSS8AjiSJIE.png',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now(),
            ],
        ];

        // upload image to storage
        foreach ($data as &$dt) {
            if (!empty('logo_file_name')) {
                // 1. open & read file
                $filePath = storage_path('seeder/' . STORAGE_PATH_TO_BRANDS . $dt['logo_file_name']);
                $file = new File($filePath);
                $fileName = STORAGE_PATH_TO_BRANDS . $file->hashName();

                // 2. upload resize to storage
                uploadImageToStorage($file, $fileName, RESIZE_BRAND_WIDTH, RESIZE_BRAND_HEIGHT, $file->extension());

                // 3. update logo_file_name field
                $dt['logo_file_name'] = $fileName;
            }
        }

        // insert data to brands table
        DB::table('brands')->insert($data);
    }
}
