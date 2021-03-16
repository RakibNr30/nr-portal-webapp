<?php

namespace Modules\Cms\Observers;

use Modules\Cms\Entities\Project;

class ProjectObserver
{
    /**
     * Handle the Content "created" event.
     *
     * @param Project $content
     * @return void
     */
    public function created(Project $content)
    {
        //
    }

    /**
     * Handle the Content "updated" event.
     *
     * @param Project $content
     * @return void
     */
    public function updated(Project $content)
    {
        //
    }

    /**
     * Handle the Content "deleted" event.
     *
     * @param Project $content
     * @return void
     */
    public function deleted(Project $content)
    {
        //
    }
}
