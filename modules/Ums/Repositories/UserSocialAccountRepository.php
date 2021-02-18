<?php

namespace Modules\Ums\Repositories;

use App\Repositories\BaseRepository;

class UserSocialAccountRepository extends BaseRepository
{
    /**
     * Set model
     * 
     * @return string
     */
    public function model()
    {
        return 'Modules\\Ums\\Entities\\UserSocialAccount';
    }
}