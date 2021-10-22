<?php

namespace GepengPHP\LaravelRBAC\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;
use App\Utils\ResponseCode;

class BaseRequest extends FormRequest
{
    protected $codeNamePrefix = null;

    public function failedValidation($validator)
    {
        $baseRequestClass = config('laravel-rbac.requests.base_request');
        if ($baseRequestClass) {
            $baseRequest = new $baseRequestClass();
            $baseRequest->failedValidation($validator);
        }
        
        throw new \Illuminate\Validation\ValidationException($validator);
    }
}
