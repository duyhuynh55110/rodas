<?php

namespace App\Modules\Api\Http\Controllers;

use App\Modules\Api\Services\CategoryService;

class CategoryController extends BaseController
{
    /**
     * Constructor
     *
     * @param  CategoryService  $categoryService
     */
    public function __construct(private CategoryService $categoryService)
    {
        parent::__construct();
    }

    /**
     * Response all categories
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $responseData = $this->categoryService->getAllCategories();

        return $this->outputJson($responseData);
    }
}