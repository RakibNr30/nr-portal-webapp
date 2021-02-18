<?php

namespace Modules\Ums\Observers;

use Modules\Ums\Entities\UserPersonalInfo;

class UserPersonalInfoObserver
{
    /**
     * Handle the UserPersonalInfo "created" event.
     *
     * @param  UserPersonalInfo  $userPersonalInfo
     * @return void
     */
    public function created(UserPersonalInfo $userPersonalInfo)
    {
        //
    }

    /**
     * Handle the UserPersonalInfo "updated" event.
     *
     * @param  UserPersonalInfo  $userPersonalInfo
     * @return void
     */
    public function updated(UserPersonalInfo $userPersonalInfo)
    {
        //
    }

    /**
     * Handle the UserPersonalInfo "deleted" event.
     *
     * @param  UserPersonalInfo  $userPersonalInfo
     * @return void
     */
    public function deleted(UserPersonalInfo $userPersonalInfo)
    {
        //
    }
}
