<?php

namespace Modules\Ums\Observers;

use Modules\Ums\Entities\UserContent;

class UserContentObserver
{
    /**
     * Handle the UserContent "created" event.
     *
     * @param  UserContent  $userContent
     * @return void
     */
    public function created(UserContent $userContent)
    {
        //
    }

    /**
     * Handle the UserContent "updated" event.
     *
     * @param  UserContent  $userContent
     * @return void
     */
    public function updated(UserContent $userContent)
    {
        //
    }

    /**
     * Handle the UserContent "deleted" event.
     *
     * @param  UserContent  $userContent
     * @return void
     */
    public function deleted(UserContent $userContent)
    {
        //
    }
}
