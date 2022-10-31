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
    protected function outputJson($data)
    {
        if ($data instanceof \League\Fractal\Resource\ResourceInterface) {
            $dataResponse = $this->fractal->createData($data)->toArray();
        } else {
            $dataResponse = collect($data)->transform(function ($item) {
                // Convert fractal instance -> array
                if ($item instanceof \League\Fractal\Resource\ResourceInterface) {
                    return current($this->fractal->createData($item)->toArray());
                }

                return $item;
            });
        }

        return response()->json([
            'status' => HTTP_CODE_OK,
            'message' => 'Ok',
            ...$dataResponse,
        ]);
    }
}
