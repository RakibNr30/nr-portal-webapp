<?php

namespace Modules\Ums\Observers;

use Modules\Ums\Entities\UserWorkInfo;

class UserWorkInfoObserver
{
    /**
     * Handle the UserWorkInfo "created" event.
     *
     * @param  UserWorkInfo  $userWorkInfo
     * @return void
     */
    public function created(UserWorkInfo $userWorkInfo)
    {
        //
    }

    /**
     * Handle the UserWorkInfo "updated" event.
     *
     * @param  UserWorkInfo  $userWorkInfo
     * @return void
     */
    public function updated(UserWorkInfo $userWorkInfo)
    {
        //
    }

    /**
     * Handle the UserWorkInfo "deleted" event.
     *
     * @param  UserWorkInfo  $userWorkInfo
     * @return void
     */
    public function deleted(UserWorkInfo $userWorkInfo)
    {
        //
    }
}
