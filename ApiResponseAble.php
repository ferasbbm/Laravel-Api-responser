<?php


namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


/**
 * trait ApiResponseAble
 * This Trait to reduce response code duplication.
 *
 * @author  feras <feras.bbm@gmail.com>
 * @package App\Http\Controllers\Api\V1
 */
trait ApiResponseAble
{
    /**
     * Resource was successfully created
     *
     * @param $data
     *
     * @return JsonResponse
     * @author <ferasbbm>
     */
    protected function createdResponse($data): JsonResponse
    {
        $response = $this->successResponse(Response::HTTP_CREATED, $data, trans('api.ItemCreatedSuccessfully'));

        return response()->json($response);
    }

    /**
     * Resource was successfully updated
     *
     * @param $data
     *
     * @return JsonResponse
     * @author <ferasbbm>
     */
    protected function updatedResponse($data): JsonResponse
    {
        $response = $this->successResponse(Response::HTTP_OK, $data, trans('api.ItemUpdatedSuccessfully'));

        return response()->json($response);
    }

    /**
     * Resource was successfully deleted
     *
     * @return JsonResponse
     * @author <ferasbbm>
     */
    protected function deletedResponse(): JsonResponse
    {
        $response = $this->successResponse(Response::HTTP_NO_CONTENT, [], trans('api.ItemDeletedSuccessfully'));

        return response()->json($response);
    }

    /**
     * Returns general error
     *
     * @param $errors
     *
     * @return JsonResponse
     * @author <ferasbbm>
     */
    protected function ApiErrorResponse($errors = null, $massage = null): JsonResponse
    {
        $response = $this->errorResponse(Response::HTTP_BAD_REQUEST, $errors, $massage);

        return response()->json($response);
    }

    /**
     * Returns general error
     *
     * @param null $data
     * @param null $massage
     *
     * @return JsonResponse
     * @author <ferasbbm>
     */
    protected function ApiSuccessResponse($data = null, $massage = null): JsonResponse
    {
        $response = $this->successResponse(Response::HTTP_OK, $data, $massage);

        return response()->json($response);
    }

    /**
     * Client does not have proper permissions to perform action.
     *
     * @return JsonResponse
     * @author <ferasbbm>
     */
    protected function unAuthorizedResponse(): JsonResponse
    {
        $response = $this->errorResponse(Response::HTTP_FORBIDDEN, null, trans('api.unAuthorized'));

        return response()->json($response);
    }

    /**
     * @return JsonResponse
     * @author <ferasbbm>
     */
    protected function unAuthenticatedResponse(): JsonResponse
    {
        $response = $this->errorResponse(Response::HTTP_UNAUTHORIZED, null, trans('api.unAuthenticated'));

        return response()->json($response);
    }

    /**
     * Returns a list of resources
     *
     * @param array $data
     *
     * @return JsonResponse
     * @author <ferasbbm>
     */
    protected function listResponse(array $data = []): JsonResponse
    {
        $response = $this->successResponse(Response::HTTP_OK, $data, trans('api.Ok'));

        return response()->json($response);
    }

    /**
     * Requested resource wasn't found
     *
     * @return JsonResponse
     * @author <ferasbbm>
     */
    protected function notFoundResponse(): JsonResponse
    {
        $response = $this->errorResponse(Response::HTTP_NOT_FOUND, [], trans('api.ItemNotFound'));

        return response()->json($response);
    }

    /**
     * Return information for single resource
     *
     * @param $data
     *
     * @return JsonResponse
     * @author <ferasbbm>
     */
    protected function showResponse($data): JsonResponse
    {
        $response = $this->successResponse(Response::HTTP_OK, $data, trans('api.Ok'));

        return response()->json($response);
    }

    /**
     * Return error when request is properly formatted, but contains validation errors
     *
     * @param $errors
     *
     * @return JsonResponse
     * @author <ferasbbm>
     */
    protected function validationErrorResponse($error): JsonResponse
    {
        $errors = [];

        foreach ($error as $key => $value) {
            $error_obj = collect($value);
            $std = new \stdClass();
            $std->field = $key;
            $std->error = $error_obj->first();
            $errors[] = $std;
        }

        $response = $this->errorResponse(Response::HTTP_UNPROCESSABLE_ENTITY, compact('errors'), trans('api.UnprocessableEntity'));

        return response()->json($response);
    }

    /**
     * Standard error envelope structure
     *
     * @param int    $code
     * @param mixed  $errors
     * @param string $message
     *
     * @return array
     * @author <ferasbbm>
     */
    private function errorResponse(int $code = Response::HTTP_BAD_REQUEST, $errors = [], string $message = 'Bad Request'): array
    {
        $response = [
            'status' => false,
            'code' => $code,
            'message' => $message,
        ];

        if (is_array($errors))
            $response = array_merge($response, $errors);
        else
            $response[ 'errors' ] = $errors;

        return $response;
    }

    /**
     * Standard success envelope structure
     *
     * @param int    $code
     * @param mixed  $data
     * @param string $message
     *
     * @return array
     * @author <ferasbbm>
     */
    private function successResponse(int $code = Response::HTTP_OK, $data = [], string $message = 'OK'): array
    {
        $response = [
            'status' => true,
            'code' => $code,
            'message' => $message,
        ];

        if (is_array($data))
            $response = array_merge($response, $data);
        else
            $response[ 'data' ] = $data;

        return $response;
    }
}


