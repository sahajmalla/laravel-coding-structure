<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait ApiResponseTrait
{
    /**
     * Send a success response with data and optional message.
     *
     * @param mixed  $data    The data to be included in the response.
     * @param string $message The optional success message.
     * @param int    $status  The HTTP status code for the response.
     *
     * @return JsonResponse
     */
    protected function sendSuccessResponse(
        $data,
        string $message = 'Success',
        int $status = ResponseAlias::HTTP_OK
    ): JsonResponse {
        $response = [
            'success' => true,
            'data'    => $data instanceof ResourceCollection ? $data->response()
                                                                    ->getData(true) : $data,
            'message' => $message,
        ];

        return response()->json($response, $status);
    }

    /**
     * Send an error response with an optional message.
     *
     * @param string $message The error message.
     * @param int    $status  The HTTP status code for the response.
     *
     * @return JsonResponse
     */
    protected function sendErrorResponse(
        string $message = 'Something went wrong.',
        int $status = ResponseAlias::HTTP_BAD_REQUEST,
    ): JsonResponse {
        return response()->json([
                                    'success' => false,
                                    'message' => $message,
                                ], $status);
    }

}
