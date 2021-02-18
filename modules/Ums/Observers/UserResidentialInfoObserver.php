<?php

namespace Modules\Ums\Observers;

use Modules\Ums\Entities\UserResidentialInfo;

class UserResidentialInfoObserver
{
    /**
     * Handle the UserResidentialInfo "created" event.
     *
     * @param  UserResidentialInfo  $userResidentialInfo
     * @return void
     */
    public function created(UserResidentialInfo $userResidentialInfo)
    {
        //
    }

    /**
     * Handle the UserResidentialInfo "updated" event.
     *
     * @param  UserResidentialInfo  $userResidentialInfo
     * @return void
     */
    public function updated(UserResidentialInfo $userResidentialInfo)
    {
        //
    }

    /**
     * Handle the UserResidentialInfo "deleted" event.
     *
     * @param  UserResidentialInfo  $userResidentialInfo
     * @return void
     */
    public function deleted(UserResidentialInfo $userResidentialInfo)
    {
        //
    }
}
