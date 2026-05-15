<?php

use Illuminate\Http\JsonResponse;

if (!function_exists('SuccesResponse')) {
    
    function SuccesResponse(bool $success, mixed $data = null, string $message = '', int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'status'    => $code,
            'data'    => $data,

        ]);
    }
}

if (!function_exists('ErrorResponse')) {
    
    function ErrorResponse(bool $success, string $message = '', int $code = 400): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'status'    => $code,

        ]);
    }
}


