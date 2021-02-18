<?php

namespace Modules\Ums\Entities;

use App\BaseModel;

class Module extends BaseModel
{
    protected $table = 'modules';

    protected $fillable = [
        'name',
		'description',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'name' => 'string',
		'description' => 'string',
    ];

    public function permissions()
    {
        return $this->hasMany('Modules\Cms\Entities\Permission');
    }
}
