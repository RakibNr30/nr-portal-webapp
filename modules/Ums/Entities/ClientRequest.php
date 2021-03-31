<?php

namespace Modules\Ums\Entities;

use App\BaseModel;

class ClientRequest extends BaseModel
{
    protected $table = 'client_requests';

    protected $fillable = [
        'full_name',
        'company_name',
        'phone',
        'email',
        'street_name',
        'house_number',
        'zip_code',
        'city',
        'description',
        'project_title',
        'project_description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'full_name' => 'string',
        'company_name' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'street_name' => 'string',
        'house_number' => 'string',
        'zip_code' => 'string',
        'city' => 'string',
        'description' => 'string',
        'project_title' => 'string',
        'project_description' => 'string',
    ];
}
