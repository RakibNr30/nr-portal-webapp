<?php

namespace Modules\Cms\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
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
            'title' => $this->title,
			'slug' => $this->slug,
			'description' => $this->description,
			'tags' => $this->tags,
			'content_category_id' => $this->content_category_id,
			'display_date' => $this->display_date,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y')
        ];
    }
}
