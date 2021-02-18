<?php

namespace Modules\Ums\Observers;

use Modules\Ums\Entities\UserEducationalInfo;

class UserEducationalInfoObserver
{
    /**
     * Handle the UserEducationalInfo "created" event.
     *
     * @param  UserEducationalInfo  $userEducationalInfo
     * @return void
     */
    public function created(UserEducationalInfo $userEducationalInfo)
    {
        //
    }

    /**
     * Handle the UserEducationalInfo "updated" event.
     *
     * @param  UserEducationalInfo  $userEducationalInfo
     * @return void
     */
    public function updated(UserEducationalInfo $userEducationalInfo)
    {
        //
    }

    /**
     * Handle the UserEducationalInfo "deleted" event.
     *
     * @param  UserEducationalInfo  $userEducationalInfo
     * @return void
     */
    public function deleted(UserEducationalInfo $userEducationalInfo)
    {
        //
    }
}
