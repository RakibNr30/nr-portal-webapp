<?php

namespace Modules\Cms\Observers;

use Modules\Cms\Entities\ContentCategory;

class ContentCategoryObserver
{
    /**
     * Handle the ContentCategory "created" event.
     *
     * @param  ContentCategory  $contentCategory
     * @return void
     */
    public function created(ContentCategory $contentCategory)
    {
        //
    }

    /**
     * Handle the ContentCategory "updated" event.
     *
     * @param  ContentCategory  $contentCategory
     * @return void
     */
    public function updated(ContentCategory $contentCategory)
    {
        //
    }

    /**
     * Handle the ContentCategory "deleted" event.
     *
     * @param  ContentCategory  $contentCategory
     * @return void
     */
    public function deleted(ContentCategory $contentCategory)
    {
        //
    }
}
