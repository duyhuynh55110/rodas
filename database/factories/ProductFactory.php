<?php

namespace Database\Factories;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Arr;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $brandIds = Brand::limit(5)->get()->pluck('id')->all();

        // list random image in path storage/products
        $imageFiles = [
            'pic1.jpg', 'pic2.jpg', 'pic3.jpg', 'pic4.jpg', 'pic5.jpg',
            'pic6.jpg', 'pic7.jpg', 'pic8.jpg', 'pic9.jpg', 'pic10.jpg',
        ];

        // product data
        $productData = [
            'brand_id' => Arr::random($brandIds),
            'name' => $this->faker->text(50),
            'description' => '<p>'.$this->faker->realText(300).'</p>',
            'image_file_name' => $imageFiles[rand(0, count($imageFiles) - 1)],
            'item_price' => rand(1, 100), // random between 1 - 100
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_by' => 1,
            'updated_at' => Carbon::now(),
        ];

        // Upload image to storage
        if (! empty($productData['image_file_name'])) {
            // 1. open & read file
            $filePath = storage_path('seeder/'.STORAGE_PATH_TO_PRODUCTS.$productData['image_file_name']);
            $file = new File($filePath);

            $fileName = STORAGE_PATH_TO_PRODUCTS.$file->hashName();

            // 2. upload resize to storage
            uploadImageToStorage($file, $fileName, RESIZE_PRODUCT_WIDTH, RESIZE_PRODUCT_HEIGHT, $file->extension());

            // 3. update logo_file_name field
            $productData['image_file_name'] = $fileName;
        }

        return $productData;
    }
}
