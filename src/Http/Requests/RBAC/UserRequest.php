<?php

namespace GepengPHP\LaravelRBAC\Http\Requests\RBAC;

use GepengPHP\LaravelRBAC\Http\Requests\BaseRequest;

class UserRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'             => 'required|max:255',
            'email'            => 'required|max:255|unique:users,email,' . request()->route('id', null),
            'password'         => 'required|between:6,64',
            'role_ids'         => 'array',
            'role_ids.*'       => 'int|exists:rbac_roles,id',
            'permission_ids'   => 'array',
            'permission_ids.*' => 'int|exists:rbac_permissions,id',
        ];
    }
}
