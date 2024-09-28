<?php

namespace App\Http\Traits;

trait ApiResponseTrait
{
    public function apiResponse($data, $message, $status = 200)
    {
        $res = [
            'data' => $data,
            'message' => $message,
        ];
        return response()->json($res,$status);
    }
}
