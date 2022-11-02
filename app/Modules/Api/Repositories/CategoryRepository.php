<?php

namespace App\Modules\Api\Repositories;

use App\Models\Category;
use Base\Repositories\Eloquent\Repository;

/**
 * CategoryRepository
 */
class CategoryRepository extends Repository
{
    /**
     * Model
     *
     * @return Category::class
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * Get all categories
     *
     * @return array
     */
    public function getAllCategories()
    {
        return $this->model->select([
            'id',
            'name',
        ])->get();
    }
}
