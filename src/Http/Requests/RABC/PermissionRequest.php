<?php

namespace GepengPHP\LaravelRBAC\Http\Requests\RABC;

//use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

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
            'name' => [
                'required',
                'between:0,50',
            ],
            'slug' => [
                'required',
                $rule,
                'between:1,50',
            ],
        ];
    }
}
