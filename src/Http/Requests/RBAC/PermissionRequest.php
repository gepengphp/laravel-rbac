<?php

namespace GepengPHP\LaravelRBAC\Http\Requests\RBAC;

use Illuminate\Validation\Rule;
use GepengPHP\LaravelRBAC\Http\Requests\BaseRequest;
use GepengPHP\LaravelRBAC\Models\RBAC\Permission;

class PermissionRequest extends BaseRequest
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
        $rule = Rule::unique('rbac_permissions');
        $id = request()->route('id', null);
        $id && $rule = $rule->ignore($id);

        return [
            'name' => 'required|between:0,50',
            'slug' => 'required|between:1,50|unique:rbac_permissions,slug,' . $id,
            'http_method' => 'array_in_array:' . implode(',', Permission::HTTP_METHODS),
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'http_method.array_in_array' => 'HTTP 方法错误'
    //     ];
    // }
}
