<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Cms\DataTables\PendingProjectDataTable;
use Modules\Cms\Http\Requests\ProjectStoreRequest;

// services...
use Modules\Cms\Services\ProjectCategoryService;
use Modules\Cms\Services\ProjectService;

class CreateProjectController extends Controller
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
     * @param PendingProjectDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('cms::project.create');
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
            $data = [
                'project_id' => 1000000000 + $project->id
            ];

            $this->projectService->update($data, $project->id);

            // flash notification
            notifier()->success('Project created successfully.');
        } else {
            // flash notification
            notifier()->error('Project cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
