<?php

namespace Modules\Cms\Entities;

use App\BaseModel;

class ArticleView extends BaseModel
{
    protected $table = 'article_views';

    protected $fillable = [
        'article_id',
		'ip_address',
		'mac_address',
		'browser',
		'latitude',
		'longitude',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'article_id' => 'integer',
		'ip_address' => 'string',
		'mac_address' => 'string',
		'browser' => 'string',
		'latitude' => 'double',
		'longitude' => 'double',
    ];
}
