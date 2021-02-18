<?php

namespace Modules\Ums\Entities;

use App\BaseModel;

class UserEducationalInfo extends BaseModel
{
    protected $table = 'user_educational_infos';

    protected $fillable = [
        'institute_name',
		'course_name',
		'degree_name',
		'start_date',
		'end_date',
		'description',
        'institute_address',
		'institute_website',
		'institute_email',
		'institute_phone',
		'user_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'institute_name' => 'string',
		'course_name' => 'string',
		'degree_name' => 'string',
		'start_date' => 'timestamp',
		'end_date' => 'timestamp',
		'description' => 'string',
        'institute_address' => 'string',
		'institute_website' => 'string',
		'institute_email' => 'string',
		'institute_phone' => 'string',
		'user_id' => 'integer',
    ];
}
