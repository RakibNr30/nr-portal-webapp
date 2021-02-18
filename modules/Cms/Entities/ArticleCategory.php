<?php

namespace Modules\Cms\Entities;

use App\BaseModel;
use Cviebrock\EloquentSluggable\Sluggable;

class ArticleCategory extends BaseModel
{
    use Sluggable;

    protected $table = 'article_categories';

    protected $fillable = [
        'title',
        'slug',
		'description',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
		'description' => 'string',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
