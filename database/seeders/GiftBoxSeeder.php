<?php

namespace Database\Seeders;

use App\Models\GiftBox;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

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
                'image_file_name' => null,
                'price' => 100,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gift Box demo 2',
                'image_file_name' => null,
                'price' => 90,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now(),
            ]
        ];


        foreach ($giftBoxsData as $data) {
            // Create gift box
            $giftBox = GiftBox::create($data);

            // Create gift box products
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

            // Create gift box products
            $giftBox->products()->sync($giftBoxProductsData);
        }
    }
}
