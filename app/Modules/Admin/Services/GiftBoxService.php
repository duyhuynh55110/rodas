<?php

namespace App\Modules\Admin\Services;

use App\Exceptions\DataNotFoundException;
use App\Modules\Admin\Repositories\GiftBoxRepository;
use Illuminate\Http\Request;

/**
 * GiftBoxService
 */
class GiftBoxService {
    /**
     * @var GiftBoxRepository
     */
    private $giftBoxRepo;

    /**
     * __construct
     *
     * @param GiftBoxRepository $giftBoxRepo
     */
    public function __construct(GiftBoxRepository $giftBoxRepo)
    {
        $this->giftBoxRepo = $giftBoxRepo;
    }

    /**
     * Data for gift boxs table
     *
     * @param Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function giftBoxsDataTable(Request $request)
    {
        $filters = [
            'name' => $request->name ?? null,
        ];

        return $this->giftBoxRepo->giftBoxsDataTable($filters);
    }

    /**
     * Get gift box by id
     *
     * @param $id
     * @return App\Models\GiftBox
     */
    public function getGiftBoxById($id)
    {
        $giftBox = $this->giftBoxRepo->find($id);

        // throw exception if not found data
        if(!$giftBox) {
            throw new DataNotFoundException();
        }

        return $giftBox;
    }
}
