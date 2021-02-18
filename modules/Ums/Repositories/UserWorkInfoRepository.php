<?php

namespace Modules\Ums\Repositories;

use App\Repositories\BaseRepository;

class UserWorkInfoRepository extends BaseRepository
{
    /**
     * Set model
     * 
     * @return string
     */
    public function model()
    {
        return 'Modules\\Ums\\Entities\\UserWorkInfo';
    }
}