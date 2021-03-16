<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\DataTables\ApprovedProjectDataTable;
use Modules\Cms\Http\Requests\ProjectStoreRequest;
use Modules\Cms\Http\Requests\ProjectUpdateRequest;

// services...
use Modules\Cms\Services\ProjectCategoryService;
use Modules\Cms\Services\ProjectService;

class ApprovedProjectController extends Controller
{
    /**
     * @var $projectService
     */
    protected $projectService;

    /**
     * Constructor
     *
     * @param ProjectService $projectService
     */
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
        $this->middleware(['permission:my_project']);
    }

    /**
     * Project list
     *
     * @param ApprovedProjectDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(ApprovedProjectDataTable $datatable)
    {
        return $datatable->render('cms::project.approved.index');
    }
    
    /**
     * Store project
     *
     * @param ProjectStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProjectStoreRequest $request)
    {
        // create project
        $project = $this->projectService->create($request->all());
        // upload files
        $project->uploadFiles();
        // check if project created
        if ($project) {
            // flash notification
            notifier()->success('Project created successfully.');
        } else {
            // flash notification
            notifier()->error('Project cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show project.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get project
        $project = $this->projectService->find($id);
        // check if project doesn't exists
        if (empty($project)) {
            // flash notification
            notifier()->error('Project not found!');
            // redirect back
            return redirect()->back();
        }

        $companies = $this->projectService->companies($project->company_id);

        // return view
        return view('cms::project.approved.show', compact('project', 'companies'));
    }

    /**
     * Show project.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get project
        $project = $this->projectService->find($id);
        // check if project doesn't exists
        if (empty($project)) {
            // flash notification
            notifier()->error('Project not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::project.edit', compact('project'));
    }

    /**
     * Update project
     *
     * @param ProjectUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProjectUpdateRequest $request, $id)
    {
        // get project
        $project = $this->projectService->find($id);
        // check if project doesn't exists
        if (empty($project)) {
            // flash notification
            notifier()->error('Project not found!');
            // redirect back
            return redirect()->back();
        }
        // update project
        $project = $this->projectService->update($request->all(), $id);
        // upload files
        $project->uploadFiles();
        // check if project updated
        if ($project) {
            // flash notification
            notifier()->success('Project updated successfully.');
        } else {
            // flash notification
            notifier()->error('Project cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete project
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get project
        $project = $this->projectService->find($id);
        // check if project doesn't exists
        if (empty($project)) {
            // flash notification
            notifier()->error('Project not found!');
            // redirect back
            return redirect()->back();
        }
        // delete project
        if ($this->projectService->delete($id)) {
            // flash notification
            notifier()->success('Project deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Project cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
