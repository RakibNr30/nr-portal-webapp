<?php

namespace Modules\Ums\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPersonalInfoStoreRequest extends FormRequest
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
            'first_name' => 'required',
			'first_name_bn' => 'required',
			'dob' => 'required',
			'gender' => 'required'
        ];
    }
}
