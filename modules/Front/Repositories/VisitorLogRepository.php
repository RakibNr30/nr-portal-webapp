<?php

namespace Modules\Front\Repositories;

use App\Repositories\BaseRepository;

class VisitorLogRepository extends BaseRepository
{
    /**
     * Set model
     * 
     * @return string
     */
    public function model()
    {
        return 'App\\VisitorLog';
    }
}