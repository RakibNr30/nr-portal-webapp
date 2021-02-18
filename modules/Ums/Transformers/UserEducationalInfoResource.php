<?php

namespace Modules\Ums\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserEducationalInfoResource extends JsonResource
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
            'institute_name' => $this->institute_name,
			'course_name' => $this->course_name,
			'degree_name' => $this->degree_name,
			'start_date' => $this->start_date,
			'end_date' => $this->end_date,
			'description' => $this->description,
			'institute_website' => $this->institute_website,
			'institute_email' => $this->institute_email,
			'institute_phone' => $this->institute_phone,
			'user_id' => $this->user_id,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y')
        ];
    }
}
