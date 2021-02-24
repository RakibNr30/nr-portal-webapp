<?php

namespace Modules\Ums\Entities;

use App\BaseModel;

class ClientRequest extends BaseModel
{
    protected $table = 'client_requests';

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'phone',
        'email',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'first_name',
        'last_name',
        'username',
        'phone' => 'string',
        'email' => 'string',
    ];
}
