<?php

namespace Modules\Ums\Observers;

use Modules\Ums\Entities\UserInterest;

class UserInterestObserver
{
    /**
     * Handle the UserInterest "created" event.
     *
     * @param  UserInterest  $userInterest
     * @return void
     */
    public function created(UserInterest $userInterest)
    {
        //
    }

    /**
     * Handle the UserInterest "updated" event.
     *
     * @param  UserInterest  $userInterest
     * @return void
     */
    public function updated(UserInterest $userInterest)
    {
        //
    }

    /**
     * Handle the UserInterest "deleted" event.
     *
     * @param  UserInterest  $userInterest
     * @return void
     */
    public function deleted(UserInterest $userInterest)
    {
        //
    }
}
