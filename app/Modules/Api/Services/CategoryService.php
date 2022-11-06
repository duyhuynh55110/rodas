<?php

namespace App\Modules\Api\Services;

use App\Modules\Api\Repositories\CategoryRepository;
use App\Modules\Api\Transformers\CategoryTransformer;

class CategoryService
{
    /**
     * Constructor
     *
     * @param  CategoryRepository  $categoryRepo
     */
    public function __construct(private CategoryRepository $categoryRepo)
    {
    }

    /**
     * Get all categories, fractal collection format
     *
     * @return League\Fractal\Resource\Collection
     */
    public function getAllCategories()
    {
        $data = $this->categoryRepo->getAllCategories();
        $collection = createFractalCollection($data, new CategoryTransformer);

        return $collection;
    }
}
