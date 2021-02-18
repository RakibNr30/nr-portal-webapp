<?php

namespace Modules\Ums\Entities;

use App\BaseModel;

class UserSocialAccount extends BaseModel
{
    protected $table = 'user_social_accounts';

    protected $fillable = [
        'username',
		'social_site_id',
		'user_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'username' => 'string',
		'social_site_id' => 'string',
		'user_id' => 'integer',
    ];


}
