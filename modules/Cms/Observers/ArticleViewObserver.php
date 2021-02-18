<?php

namespace Modules\Cms\Observers;

use Modules\Cms\Entities\ArticleView;

class ArticleViewObserver
{
    /**
     * Handle the ArticleView "created" event.
     *
     * @param  ArticleView  $articleView
     * @return void
     */
    public function created(ArticleView $articleView)
    {
        //
    }

    /**
     * Handle the ArticleView "updated" event.
     *
     * @param  ArticleView  $articleView
     * @return void
     */
    public function updated(ArticleView $articleView)
    {
        //
    }

    /**
     * Handle the ArticleView "deleted" event.
     *
     * @param  ArticleView  $articleView
     * @return void
     */
    public function deleted(ArticleView $articleView)
    {
        //
    }
}
