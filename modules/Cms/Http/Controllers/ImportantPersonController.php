<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\Http\Requests\ImportantPersonStoreRequest;
use Modules\Cms\Http\Requests\ImportantPersonUpdateRequest;

// datatable...
use Modules\Cms\Datatables\ImportantPersonDatatable;

// services...
use Modules\Cms\Services\ImportantPersonService;

class ImportantPersonController extends Controller
{
    /**
     * @var $importantPersonService
     */
    protected $importantPersonService;

    /**
     * Constructor
     *
     * @param ImportantPersonService $importantPersonService
     */
    public function __construct(ImportantPersonService $importantPersonService)
    {
        $this->importantPersonService = $importantPersonService;
    }

    /**
     * ImportantPerson list
     *
     * @param ImportantPersonDatatable $datatable
     * @return \Illuminate\View\View
     */
    public function index(ImportantPersonDatatable $datatable)
    {
        return $datatable->render('cms::important_person.index');
    }

    /**
     * Create importantPerson
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('cms::important_person.create');
    }


    /**
     * Store importantPerson
     *
     * @param ImportantPersonStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ImportantPersonStoreRequest $request)
    {
        // create importantPerson
        $importantPerson = $this->importantPersonService->create($request->all());
        // check if importantPerson created
        if ($importantPerson) {
            // flash notification
            notifier()->success('ImportantPerson created successfully.');
        } else {
            // flash notification
            notifier()->error('ImportantPerson cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show importantPerson.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get importantPerson
        $importantPerson = $this->importantPersonService->find($id);
        // check if importantPerson doesn't exists
        if (empty($importantPerson)) {
            // flash notification
            notifier()->error('ImportantPerson not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::important_person.show', compact('importantPerson'));
    }

    /**
     * Show importantPerson.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get importantPerson
        $importantPerson = $this->importantPersonService->find($id);
        // check if importantPerson doesn't exists
        if (empty($importantPerson)) {
            // flash notification
            notifier()->error('ImportantPerson not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::important_person.edit', compact('importantPerson'));
    }

    /**
     * Update importantPerson
     *
     * @param ImportantPersonUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ImportantPersonUpdateRequest $request, $id)
    {
        // get importantPerson
        $importantPerson = $this->importantPersonService->find($id);
        // check if importantPerson doesn't exists
        if (empty($importantPerson)) {
            // flash notification
            notifier()->error('ImportantPerson not found!');
            // redirect back
            return redirect()->back();
        }
        // update importantPerson
        $importantPerson = $this->importantPersonService->update($request->all(), $id);
        // check if importantPerson updated
        if ($importantPerson) {
            // flash notification
            notifier()->success('ImportantPerson updated successfully.');
        } else {
            // flash notification
            notifier()->error('ImportantPerson cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete importantPerson
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get importantPerson
        $importantPerson = $this->importantPersonService->find($id);
        // check if importantPerson doesn't exists
        if (empty($importantPerson)) {
            // flash notification
            notifier()->error('ImportantPerson not found!');
            // redirect back
            return redirect()->back();
        }
        // delete importantPerson
        if ($this->importantPersonService->delete($id)) {
            // flash notification
            notifier()->success('ImportantPerson deleted successfully.');
        } else {
            // flash notification
            notifier()->success('ImportantPerson cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
