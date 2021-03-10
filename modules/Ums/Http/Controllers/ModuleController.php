<?php

namespace Modules\Ums\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\ModuleStoreRequest;
use Modules\Ums\Http\Requests\ModuleUpdateRequest;

// datatable...
use Modules\Ums\Datatables\ModuleDatatable;

// services...
use Modules\Ums\Services\ModuleService;

class ModuleController extends Controller
{
    /**
     * @var $moduleService
     */
    protected $moduleService;

    /**
     * Constructor
     *
     * @param ModuleService $moduleService
     */
    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
        $this->middleware(['permission:core_settings']);
    }

    /**
     * Module list
     *
     * @param ModuleDatatable $datatable
     * @return \Illuminate\View\View
     */
    public function index(ModuleDatatable $datatable)
    {
        return $datatable->render('ums::module.index');
    }

    /**
     * Create module
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('ums::module.create');
    }


    /**
     * Store module
     *
     * @param ModuleStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ModuleStoreRequest $request)
    {
        // create module
        $module = $this->moduleService->create($request->all());
        // check if module created
        if ($module) {
            // flash notification
            notifier()->success('Module created successfully.');
        } else {
            // flash notification
            notifier()->error('Module cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show module.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get module
        $module = $this->moduleService->find($id);
        // check if module doesn't exists
        if (empty($module)) {
            // flash notification
            notifier()->error('Module not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::module.show', compact('module'));
    }

    /**
     * Show module.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get module
        $module = $this->moduleService->find($id);
        // check if module doesn't exists
        if (empty($module)) {
            // flash notification
            notifier()->error('Module not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::module.edit', compact('module'));
    }

    /**
     * Update module
     *
     * @param ModuleUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ModuleUpdateRequest $request, $id)
    {
        // get module
        $module = $this->moduleService->find($id);
        // check if module doesn't exists
        if (empty($module)) {
            // flash notification
            notifier()->error('Module not found!');
            // redirect back
            return redirect()->back();
        }
        // update module
        $module = $this->moduleService->update($request->all(), $id);
        // check if module updated
        if ($module) {
            // flash notification
            notifier()->success('Module updated successfully.');
        } else {
            // flash notification
            notifier()->error('Module cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete module
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get module
        $module = $this->moduleService->find($id);
        // check if module doesn't exists
        if (empty($module)) {
            // flash notification
            notifier()->error('Module not found!');
            // redirect back
            return redirect()->back();
        }
        // delete module
        if ($this->moduleService->delete($id)) {
            // flash notification
            notifier()->success('Module deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Module cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
