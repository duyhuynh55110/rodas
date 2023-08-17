<?php

namespace App\Modules\Api\Http\Controllers;

use App\Modules\Api\Services\CategoryService;

class CategoryController extends BaseController
{
    /**
     * Constructor
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

    /**
     * Response a category
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $responseData = $this->categoryService->getCategoryById($id);

        return $this->outputJson($responseData);
    }
}
