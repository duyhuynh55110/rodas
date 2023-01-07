<?php

namespace App\Modules\Api\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Libs\CustomFractalSerializer;
use League\Fractal\Manager as FractalManager;

class BaseController extends Controller
{
    /**
     * @var FractalManager
     */
    protected $fractal;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fractal = new FractalManager();
        $this->fractal->setSerializer(new CustomFractalSerializer);
    }

    /**
     * API output manage by fractal
     *
     * @param  \League\Fractal\Resource\ResourceInterface|array  $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function outputJson($data, $groupInData = true)
    {
        if ($data instanceof \League\Fractal\Resource\ResourceInterface) {
            $dataResponse = $this->fractal->createData($data)->toArray();

            // not group in data because collection can have two fields 'data' & 'meta.pagination'
            if ($data instanceof \League\Fractal\Resource\Collection) {
                $groupInData = false;
            }
        } else {
            $dataResponse = collect($data)->transform(function ($item) {
                // Convert fractal instance -> array
                if ($item instanceof \League\Fractal\Resource\ResourceInterface) {
                    return $this->fractal->createData($item)->toArray();
                }

                return $item;
            });
        }

        $response = [
            'status' => HTTP_CODE_OK,
            'message' => 'Ok',
            ...(! $groupInData) ? $dataResponse : ['data' => $dataResponse], // true: data: {...}, false: without data object
        ];

        return response()->json($response);
    }
}
