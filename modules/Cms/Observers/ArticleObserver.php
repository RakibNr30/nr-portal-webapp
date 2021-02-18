<?php

namespace Modules\Cms\Observers;

use Modules\Cms\Entities\Article;

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     *
     * @param  Article  $article
     * @return void
     */
    public function created(Article $article)
    {
        //
    }

    /**
     * Handle the Article "updated" event.
     *
     * @param  Article  $article
     * @return void
     */
    public function updated(Article $article)
    {
        //
    }

    /**
     * Handle the Article "deleted" event.
     *
     * @param  Article  $article
     * @return void
     */
    public function deleted(Article $article)
    {
        //
    }
}
