<?php

namespace App\Modules\Admin\Repositories;

use Base\Repositories\Eloquent\Repository;
use App\Models\Category;

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
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getCategories()
    {
        return $this->model->select(
            [
                'id',
                'name',
            ]
        )->get();
    }
}
