<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * API output
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function outputJson($data)
    {
        $response = [
            'status' => HTTP_CODE_OK,
            'message' => 'Ok',
            'data' => $data,
        ];

        return response()->json($response);
    }
}
