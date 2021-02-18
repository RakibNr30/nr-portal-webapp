<?php

namespace Modules\Ums\Entities;

use App\BaseModel;

class UserContent extends BaseModel
{
    protected $table = 'user_contents';

    protected $fillable = [
        'name',
		'description',
		'proficiency',
		'content_category_id',
		'user_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'name' => 'string',
		'description' => 'string',
		'proficiency' => 'integer',
		'content_category_id' => 'integer',
		'user_id' => 'integer',
    ];


}
