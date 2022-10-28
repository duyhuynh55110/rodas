<?php

namespace Database\Seeders;

use App\Models\GiftBox;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;

class GiftBoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // gift_boxs data
        $giftBoxsData = [
            [
                'name' => 'Gift Box demo 1',
                'image_file_name' => '1.jpg',
                'price' => 100,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gift Box demo 2',
                'image_file_name' => '2.jpg',
                'price' => 90,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gift Box demo 3',
                'image_file_name' => '3.jpg',
                'price' => 80,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gift Box demo 4',
                'image_file_name' => '4.jpg',
                'price' => 70,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($giftBoxsData as $data) {
            // --- update image to storage
            // 1. open & read file
            $filePath = storage_path('seeder/'.STORAGE_PATH_TO_GIFT_BOXS.$data['image_file_name']);
            $file = new File($filePath);

            $fileName = STORAGE_PATH_TO_GIFT_BOXS.$file->hashName();

            // 2. upload resize to storage
            uploadImageToStorage($file, $fileName, RESIZE_GIFT_BOX_WIDTH, RESIZE_GIFT_BOX_HEIGHT, $file->extension());

            // 3. update logo_file_name field
            $data['image_file_name'] = $fileName;

            // --- create gift box
            $giftBox = GiftBox::create($data);

            // --- create gift box products
            $products = Product::get()->random(5);
            $giftBoxProductsData = $products->map(
                function ($product) use ($giftBox) {
                    return [
                        'gift_box_id' => $giftBox->id,
                        'product_id' => $product->id,
                        'quantity' => rand(1, 7),
                        'created_by' => 1,
                        'created_at' => Carbon::now(),
                        'updated_by' => 1,
                        'updated_at' => Carbon::now(),
                    ];
                }
            );

            $giftBox->products()->sync($giftBoxProductsData);
        }
    }
}
