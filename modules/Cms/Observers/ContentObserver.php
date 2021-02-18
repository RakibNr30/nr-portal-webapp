<?php

namespace Modules\Cms\Observers;

use Modules\Cms\Entities\Content;

class ContentObserver
{
    /**
     * Handle the Content "created" event.
     *
     * @param  Content  $content
     * @return void
     */
    public function created(Content $content)
    {
        //
    }

    /**
     * Handle the Content "updated" event.
     *
     * @param  Content  $content
     * @return void
     */
    public function updated(Content $content)
    {
        //
    }

    /**
     * Handle the Content "deleted" event.
     *
     * @param  Content  $content
     * @return void
     */
    public function deleted(Content $content)
    {
        //
    }
}
