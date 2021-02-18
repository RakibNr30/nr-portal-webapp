<?php

namespace Modules\Ums\Entities;

use App\BaseModel;

class UserWorkInfo extends BaseModel
{
    protected $table = 'user_work_infos';

    protected $fillable = [
        'company_name',
        'department',
        'designation',
        'start_date',
        'end_date',
        'description',
        'company_address',
		'company_website',
        'company_email',
        'company_phone',
		'user_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'company_name' => 'string',
        'department' => 'string',
        'designation' => 'string',
        'start_date' => 'timestamp',
        'end_date' => 'timestamp',
        'description' => 'string',
        'company_address' => 'string',
		'company_website' => 'string',
        'company_email' => 'string',
        'company_phone' => 'string',
		'user_id' => 'integer',
    ];
}
