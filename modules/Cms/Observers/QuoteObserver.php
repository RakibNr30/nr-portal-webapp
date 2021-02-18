<?php

namespace Modules\Cms\Observers;

use Modules\Cms\Entities\Quote;

class QuoteObserver
{
    /**
     * Handle the Quote "created" event.
     *
     * @param  Quote  $quote
     * @return void
     */
    public function created(Quote $quote)
    {
        //
    }

    /**
     * Handle the Quote "updated" event.
     *
     * @param  Quote  $quote
     * @return void
     */
    public function updated(Quote $quote)
    {
        //
    }

    /**
     * Handle the Quote "deleted" event.
     *
     * @param  Quote  $quote
     * @return void
     */
    public function deleted(Quote $quote)
    {
        //
    }
}
