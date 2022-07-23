<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // number of random data
        $count = 30;

        // Create random products
        $products = Product::factory()->count($count)->create();
        $categoryIds = Category::get()->pluck('id')->all();

        // Map products
        $products->map(
            function ($product) use ($categoryIds) {
                // Create random category product
                $product->categories()->sync(
                    [
                        Arr::random($categoryIds) => [
                            'created_by' => 1,
                            'created_at' => Carbon::now(),
                            'updated_by' => 1,
                            'updated_at' => Carbon::now(),
                        ]
                    ]
                );
            }
        );
    }
}
