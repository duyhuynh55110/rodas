<?php

namespace App\Modules\Api\Http\Controllers;

use App\Http\Controllers\Controller;
use League\Fractal\Manager as FractalManager;
use League\Fractal\Serializer\ArraySerializer;

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
        $this->fractal->setSerializer(new ArraySerializer);
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

            if ($data instanceof \League\Fractal\Resource\Collection) {
                $groupInData = false;
            }
        } else {
            $dataResponse = collect($data)->transform(function ($item) {
                // Convert fractal instance -> array
                if ($item instanceof \League\Fractal\Resource\Collection) {
                    return current($this->fractal->createData($item)->toArray());
                } else if ($item instanceof \League\Fractal\Resource\ResourceInterface) {
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
