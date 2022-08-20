<?php

namespace App\Modules\Admin\Services;

use App\Modules\Admin\Repositories\CategoryRepository;

/**
 * CategoryService
 */
class CategoryService
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepo;

    /**
     * __construct
     *
     * @param CategoryRepository $categoryRepo
     */
    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Get list all categories
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAllCategories()
    {
        return $this->categoryRepo->getCategories();
    }
}
