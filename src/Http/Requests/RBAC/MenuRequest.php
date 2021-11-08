<?php

namespace GepengPHP\LaravelRBAC\Http\Requests\RBAC;

use GepengPHP\LaravelRBAC\Http\Requests\BaseRequest;

class MenuRequest extends BaseRequest
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
            'parent_id'       => 'required|exits-or-zero:rbac_menu,id',
            'title'           => 'required|max:50',
            'icon'            => 'required|max:50',
            'uri'             => 'max:50',
            'order'           => 'integer|numeric|min:-99999|max:99999',
            'permission_slug' => 'exists:rbac_permissions,slug',
            'role_ids'        => 'array',
            'role_ids.*'      => 'numeric|exists:rbac_roles,id',
        ];
    }
}
