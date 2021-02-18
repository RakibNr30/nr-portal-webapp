<?php

namespace Modules\Cms\Observers;

use Modules\Cms\Entities\ArticleCategory;

class ArticleCategoryObserver
{
    /**
     * Handle the ArticleCategory "created" event.
     *
     * @param  ArticleCategory  $articleCategory
     * @return void
     */
    public function created(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Handle the ArticleCategory "updated" event.
     *
     * @param  ArticleCategory  $articleCategory
     * @return void
     */
    public function updated(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Handle the ArticleCategory "deleted" event.
     *
     * @param  ArticleCategory  $articleCategory
     * @return void
     */
    public function deleted(ArticleCategory $articleCategory)
    {
        //
    }
}
