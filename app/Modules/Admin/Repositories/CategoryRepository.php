<?php

namespace App\Modules\Admin\Repositories;

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
