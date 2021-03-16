<?php

namespace Modules\Cms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectApproveRequest extends FormRequest
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
            /*'title' => 'required',
            'description' => 'required',
            'image' => 'sometimes|image',
            'attachment' => 'sometimes',*/
            'company_id' => 'required|array|min:1|max:3',
        ];
    }
}
