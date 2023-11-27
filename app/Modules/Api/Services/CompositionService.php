<?php

namespace App\Modules\Api\Services;

use App\Modules\Api\Repositories\CategoryRepository;
use App\Modules\Api\Repositories\GiftBoxRepository;
use App\Modules\Api\Transformers\CategoryTransformer;
use App\Modules\Api\Transformers\GiftBoxTransformer;

class CompositionService
{
    /**
     * Constructor
     */
    public function __construct(private CategoryRepository $categoryRepo, private GiftBoxRepository $giftBoxRepo)
    {
    }

    /**
     * Master data for home page
     *
     * @return array
     */
    public function homePage()
    {
        $categoriesCollection = createFractalCollection($this->categoryRepo->getAllCategories(), new CategoryTransformer, null);
        $giftBoxes = createFractalCollection($this->giftBoxRepo->getAllGiftBoxes(), new GiftBoxTransformer, null);

        return [
            'categories' => $categoriesCollection,
            'gift_boxes' => $giftBoxes,
        ];
    }
}
