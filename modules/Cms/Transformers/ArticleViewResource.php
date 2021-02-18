<?php

namespace Modules\Cms\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleViewResource extends JsonResource
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
            'article_id' => $this->article_id,
			'ip_address' => $this->ip_address,
			'mac_address' => $this->mac_address,
			'browser' => $this->browser,
			'latitude' => $this->latitude,
			'longitude' => $this->longitude,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y')
        ];
    }
}
