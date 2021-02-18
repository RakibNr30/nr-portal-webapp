<?php

namespace Modules\Ums\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResidentialInfoResource extends JsonResource
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
            'present_country' => $this->present_country,
			'present_city' => $this->present_city,
			'present_state' => $this->present_state,
			'present_address_line_1' => $this->present_address_line_1,
			'present_address_line_2' => $this->present_address_line_2,
			'permanent_country' => $this->permanent_country,
			'permanent_city' => $this->permanant_city,
			'permanent_state' => $this->permanent_state,
			'permanent_address_line_1' => $this->permanent_address_line_1,
			'permanent_address_line_2' => $this->permanent_address_line_2,
			'google_map_url' => $this->google_map_url,
			'longitude' => $this->longitude,
			'latitude' => $this->latitude,
			'user_id' => $this->user_id,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y')
        ];
    }
}
