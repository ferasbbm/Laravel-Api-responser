# Laravel API Responser

The Laravel API Responser is a trait that helps reduce code duplication when handling API responses in Laravel. It provides several methods for generating standardized JSON responses with appropriate HTTP status codes.

## Installation

To use the Laravel API Responser, follow these steps:

1. Copy the `ApiResponseAble` trait file to your Laravel project.
2. Import the trait in your controller file:

   ```php
   use App\Http\Controllers\Api\V1\ApiResponseAble;
	```
3. Use the trait in your controller:
	 
	 ```php
	  use ApiResponseAble;
	```
## Available Methods

### `createdResponse($data): JsonResponse`

This method is used to generate a JSON response for a successful resource creation. It returns a `JsonResponse` object with the HTTP status code 201 (Created) and a success message.

Example usage:

```php
return $this->createdResponse($data);
```

### `updatedResponse($data): JsonResponse`

This method is used to generate a JSON response for a successful resource update. It returns a `JsonResponse` object with the HTTP status code 200 (OK) and a success message.

Example usage:

```php
return $this->updatedResponse($data);
```

### `deletedResponse(): JsonResponse`

This method is used to generate a JSON response for a successful resource deletion. It returns a `JsonResponse` object with the HTTP status code 204 (No Content) and a success message.

Example usage:

```php
return $this->deletedResponse();
```

### `ApiErrorResponse($errors = null, $message = null): JsonResponse`

This method is used to generate a JSON response for a general error. It returns a `JsonResponse` object with the HTTP status code 400 (Bad Request), an optional error message, and optional error data.

Example usage:

```php
return $this->ApiErrorResponse($errors, $message);
```

### `ApiSuccessResponse($data = null, $message = null): JsonResponse`

This method is used to generate a JSON response for a general success. It returns a `JsonResponse` object with the HTTP status code 200 (OK), an optional success message, and optional data.

Example usage:
```php
return $this->ApiSuccessResponse($data, $message);
```

### `unAuthorizedResponse(): JsonResponse`

This method is used to generate a JSON response for an unauthorized access attempt. It returns a `JsonResponse` object with the HTTP status code 403 (Forbidden) and an error message indicating insufficient permissions.

Example usage:
```php
return $this->unAuthorizedResponse();
```

### `unAuthenticatedResponse(): JsonResponse`

This method is used to generate a JSON response for an unauthenticated access attempt. It returns a `JsonResponse` object with the HTTP status code 401 (Unauthorized) and an error message indicating the need for authentication.

Example usage:

```php
return $this->unAuthenticatedResponse();
```

### `listResponse(array $data = []): JsonResponse`

This method is used to generate a JSON response for a list of resources. It returns a `JsonResponse` object with the HTTP status code 200 (OK) and the provided data.

Example usage:

```php
return $this->listResponse($data);
```

### `notFoundResponse(): JsonResponse`

This method is used to generate a JSON response for a resource not found error. It returns a `JsonResponse` object with the HTTP status code 404 (Not Found) and an error message indicating that the requested resource was not found.

Example usage:

```php
return $this->notFoundResponse();
```

### `showResponse($data): JsonResponse`

This method is used to generate a JSON response for a single resource.

Example usage:

```php
return $this->showResponse($data);
```

### `validationErrorResponse($errorsArray)`

The `validationErrorResponse()` function is used to return an error response when the request is properly formatted but contains validation errors. It takes an array of validation errors as input and generates a JSON response with the appropriate error envelope structure.

Example usage:

```php
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        // Additional validation rules
    ]);

    if ($validator->fails()) {
        return $this->validationErrorResponse($validator->errors());
    }

    // Process the request if validation passes
    // ...
}
```

### `errorResponse($code = Response::HTTP_BAD_REQUEST, $errors = [], $message = 'Bad Request')`

The `errorResponse()` function is  used to generate a standard error response envelope structure. It takes three optional parameters: `$code`, `$errors`, and `$message`, which allow customization of the response.

Example usage:

```php
public function show($id)
{
    $user = User::find($id);

    if (!$user) {
        $errors = [
            'user_id' => 'User not found.',
        ];
        
        return $this->errorResponse(Response::HTTP_NOT_FOUND, $errors, 'User Not Found');
    }

    // Return the user data if found
    return $this->showResponse($user);
}
```

### `successResponse($code = Response::HTTP_OK, $data = [], $message = 'OK')`

The `successResponse()` function is used to generate a standard success response envelope structure. It takes three optional parameters: `$code`, `$data`, and `$message`, which allow customization of the response.

Example usage:
```php
public function store(Request $request)
{
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
    ]);

    if ($validator->fails()) {
        $errors = $validator->errors()->toArray();
        
        return $this->validationErrorResponse($errors);
    }

    // Store the user data
    // ...

    // Return a success response
    return $this->successResponse(Response::HTTP_CREATED, [], 'User created successfully.');
}
```

---
🌟 Give this repo a star and show your support! 🌟

Thank you for taking the time to explore this repository and learn about the `ApiResponseAble` trait. If you found it helpful or valuable in your Laravel API development, please consider giving it a star and liking it.

By showing your support, you contribute to the recognition of the hard work put into creating and maintaining this code. It also serves as a motivation for the author to continue improving and sharing more useful resources with the community.

Your feedback and engagement mean a lot! If you have any suggestions, bug reports, or feature requests, feel free to open an issue or submit a pull request. Together, we can make this project even better.

Once again, thank you for your support and for being part of this open-source community. Your star and like are greatly appreciated! ⭐❤️


## Authors

-   [feras](mailto:feras.bbm@gmail.com)
