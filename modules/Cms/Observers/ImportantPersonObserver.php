<?php

namespace Modules\Cms\Observers;

use Modules\Cms\Entities\ImportantPerson;

class ImportantPersonObserver
{
    /**
     * Handle the ImportantPerson "created" event.
     *
     * @param  ImportantPerson  $importantPerson
     * @return void
     */
    public function created(ImportantPerson $importantPerson)
    {
        //
    }

    /**
     * Handle the ImportantPerson "updated" event.
     *
     * @param  ImportantPerson  $importantPerson
     * @return void
     */
    public function updated(ImportantPerson $importantPerson)
    {
        //
    }

    /**
     * Handle the ImportantPerson "deleted" event.
     *
     * @param  ImportantPerson  $importantPerson
     * @return void
     */
    public function deleted(ImportantPerson $importantPerson)
    {
        //
    }
}
