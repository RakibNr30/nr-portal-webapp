<?php

namespace Modules\Cms\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
			'description' => $this->description,
			'approve_status' => $this->approve_status,
			'approved_at' => $this->approved_at,
			'approved_by' => $this->approved_by,
			'article_category_id' => $this->article_category_id,
			'author_id' => $this->author_id,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y')
        ];
    }
}
