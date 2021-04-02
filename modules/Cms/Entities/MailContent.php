<?php

namespace Modules\Cms\Entities;

use App\BaseModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class MailContent extends BaseModel
{

    protected $table = 'mail_contents';

    protected $fillable = [
        'subject',
		'body',
		'mail_category_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'subject' => 'string',
		'body' => 'string',
		'mail_category_id' => 'integer',
    ];
}
