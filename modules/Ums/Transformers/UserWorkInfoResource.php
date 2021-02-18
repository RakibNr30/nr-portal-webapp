<?php

namespace Modules\Ums\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserWorkInfoResource extends JsonResource
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
            'company_name' => $this->company_name,
            'department' => $this->department,
            'designation' => $this->designation,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => $this->description,
            'company_address' => $this->company_address,
			'company_website' => $this->company_website,
			'company_email' => $this->company_email,
			'company_phone' => $this->company_phone,
			'user_id' => $this->user_id,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y')
        ];
    }
}
