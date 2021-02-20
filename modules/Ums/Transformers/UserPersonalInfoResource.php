<?php

namespace Modules\Ums\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserBasicInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'first_name_bn' => $this->first_name_bn,
			'last_name_bn' => $this->last_name_bn,
			'designation' => $this->designation,
			'about' => $this->about,
			'phone_no' => $this->phone_no,
			'mobile_no' => $this->mobile_no,
			'fax_no' => $this->fax_no,
			'personal_email' => $this->personal_email,
			'professional_email' => $this->professional_email,
			'website_url' => $this->website_url,
			'dob' => $this->dob,
			'blood_group' => $this->blood_group,
			'gender' => $this->gender,
			'user_id' => $this->user_id,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y')
        ];
    }
}
