<?php

namespace Modules\Ums\Observers;

use Modules\Ums\Entities\UserBasicInfo;

class UserBasicInfoObserver
{
    /**
     * Handle the UserBasicInfo "created" event.
     *
     * @param  UserBasicInfo  $userBasicInfo
     * @return void
     */
    public function created(UserBasicInfo $userBasicInfo)
    {
        //
    }

    /**
     * Handle the UserBasicInfo "updated" event.
     *
     * @param  UserBasicInfo  $userBasicInfo
     * @return void
     */
    public function updated(UserBasicInfo $userBasicInfo)
    {
        //
    }

    /**
     * Handle the UserBasicInfo "deleted" event.
     *
     * @param  UserBasicInfo  $userBasicInfo
     * @return void
     */
    public function deleted(UserBasicInfo $userBasicInfo)
    {
        //
    }
}
