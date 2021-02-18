<?php

namespace Modules\Ums\Entities;

use App\BaseModel;

class UserInterest extends BaseModel
{
    protected $table = 'user_interests';

    protected $fillable = [
        'name',
		'description',
		'user_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'name' => 'string',
		'description' => 'string',
		'user_id' => 'integer',
    ];


}
