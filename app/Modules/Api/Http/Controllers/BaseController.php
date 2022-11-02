<?php

namespace App\Modules\Api\Http\Controllers;

use App\Http\Controllers\Controller;
use League\Fractal\Manager as FractalManager;

class BaseController extends Controller
{
    /**
     * @var FractalManager
     */
    private $fractal;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fractal = new FractalManager();
    }

    /**
     * API output manage by fractal
     *
     * @param  \League\Fractal\Resource\ResourceInterface|array  $data
     * @return array
     */
    protected function outputJson($data, $groupInData = true)
    {
        if ($data instanceof \League\Fractal\Resource\ResourceInterface) {
            $dataResponse = $this->fractal->createData($data)->toArray();
            $groupInData = false;
        } else {
            $dataResponse = collect($data)->transform(function ($item) {
                // Convert fractal instance -> array
                if ($item instanceof \League\Fractal\Resource\ResourceInterface) {
                    return current($this->fractal->createData($item)->toArray());
                }

                return $item;
            });
        }

        $baseData = [
            'status' => HTTP_CODE_OK,
            'message' => 'Ok',
        ];

        $response = [
            ...$baseData,
            ...(! $groupInData) ? $dataResponse : ['data' => $dataResponse], // true: data: {...}, false: without data object
        ];

        return response()->json($response);
    }
}
