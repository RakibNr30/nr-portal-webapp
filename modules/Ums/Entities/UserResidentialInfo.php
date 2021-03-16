<?php

namespace Modules\Ums\Entities;

use App\BaseModel;

class UserResidentialInfo extends BaseModel
{
    protected $table = 'user_residential_infos';

    protected $fillable = [
        'present_country',
		'present_city',
		'present_state',
		'present_address_line_1',
		'present_address_line_2',
		'permanent_country',
		'permanent_city',
		'permanent_state',
		'permanent_address_line_1',
		'permanent_address_line_2',
        'present_street_name',
        'permanent_street_name',
        'present_house_number',
        'permanent_house_number',
        'present_zip_code',
        'permanent_zip_code',
		'user_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'present_country' => 'string',
		'present_city' => 'string',
		'present_state' => 'string',
		'present_address_line_1' => 'string',
		'present_address_line_2' => 'string',
		'permanent_country' => 'string',
		'permanent_city' => 'string',
		'permanent_state' => 'string',
		'permanent_address_line_1' => 'string',
		'permanent_address_line_2' => 'string',
        'present_street_name' => 'string',
        'permanent_street_name' => 'string',
        'present_house_number' => 'string',
        'permanent_house_number' => 'string',
        'present_zip_code' => 'string',
        'permanent_zip_code' => 'string',
		'user_id' => 'integer'
    ];


}
