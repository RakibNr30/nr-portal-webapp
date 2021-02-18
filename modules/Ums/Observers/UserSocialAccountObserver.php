<?php

namespace Modules\Ums\Observers;

use Modules\Ums\Entities\UserSocialAccount;

class UserSocialAccountObserver
{
    /**
     * Handle the UserSocialAccount "created" event.
     *
     * @param  UserSocialAccount  $userSocialAccount
     * @return void
     */
    public function created(UserSocialAccount $userSocialAccount)
    {
        //
    }

    /**
     * Handle the UserSocialAccount "updated" event.
     *
     * @param  UserSocialAccount  $userSocialAccount
     * @return void
     */
    public function updated(UserSocialAccount $userSocialAccount)
    {
        //
    }

    /**
     * Handle the UserSocialAccount "deleted" event.
     *
     * @param  UserSocialAccount  $userSocialAccount
     * @return void
     */
    public function deleted(UserSocialAccount $userSocialAccount)
    {
        //
    }
}
