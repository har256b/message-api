<?php 

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    /**
     * Sends custom response with given status and message
     *
     * @param $status
     * @param $message
     * @return JsonResponse
     */
    public function sendCustomResponse($status, $message)
    {
        return response()->json(['status' => $status, 'message' => $message], $status);
    }

    /**
     * Send 403 forbidden response
     *
     * @param string $message
     * @return JsonResponse
     */
    public function sendForbiddenResponse($message = '')
    {
        if ($message === '') {
            $message = 'Forbidden';
        }
        return response()->json(['status' => Response::HTTP_FORBIDDEN, 'message' => $message], Response::HTTP_FORBIDDEN);
    }

    /**
     * Send 404 not found response
     *
     * @param string $message
     * @return JsonResponse
     */
    public function sendNotFoundResponse($message = '')
    {
        if ($message === '') {
            $message = 'The requested resource was not found';
        }

        return response()->json(['status' => Response::HTTP_NOT_FOUND, 'message' => $message], Response::HTTP_NOT_FOUND);
    }

    /**
     * Send empty data response
     *
     * @return string
     */
    public function sendEmptyDataResponse()
    {
        return response()->json(['status' => Response::HTTP_NO_CONTENT, 'data' => new \StdClass()], Response::HTTP_NO_CONTENT);
    }

    /**
     * Send 200 success response
     *
     * @param Collection $collection
     */
    protected function sendSuccessResponse($response)
    {
        // for additional response mutation when required
        return $response->response()->setStatusCode(Response::HTTP_OK);
    }
}