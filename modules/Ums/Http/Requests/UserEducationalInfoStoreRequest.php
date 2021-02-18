<?php

namespace Modules\Ums\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEducationalInfoStoreRequest extends FormRequest
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
            'institute_name' => 'required|max:255',
			'course_name' => 'required',
			'degree_name' => 'required',
			'start_date' => 'required'
        ];
    }
}
