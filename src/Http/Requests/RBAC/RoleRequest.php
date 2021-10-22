<?php

namespace GepengPHP\LaravelRBAC\Http\Requests\RBAC;

use GepengPHP\LaravelRBAC\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends BaseRequest
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
        $rule = Rule::unique('rbac_roles');
        $id = request()->route('id', null);
        $id && $rule = $rule->ignore($id);

        return [
            'name' => [
                'required',
                'between:0,50',
            ],
            'slug' => [
                'required',
                $rule,
                'between:1,50',
            ],
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'required|int|exists:rbac_permissions,id',
        ];
    }
}
