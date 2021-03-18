<?php

namespace Modules\Ums\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
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

            // find route id
            $id = request()->route()->parameters()[request()->route()->parameterNames[0]],

            'company_name' => 'required',
            'about' => 'required',
            'avatar' => 'sometimes|image|max:512',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            // 'password' => 'required|min:6|confirmed',
            //'roles' => 'required|array|min:1',
        ];
    }
}
