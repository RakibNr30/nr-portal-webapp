<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Notification;
use Illuminate\Support\Facades\Auth;
use Modules\Cms\DataTables\PendingProjectDataTable;
use Modules\Cms\Http\Requests\ProjectStoreRequest;

// services...
use Modules\Cms\Services\ProjectCategoryService;
use Modules\Cms\Services\ProjectService;
use Modules\Ums\Entities\UserBasicInfo;

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
        $this->middleware(['permission:create_project']);
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
        //$project->uploadFiles();

        //dd($request->file('images'));

        if($request->file('images')) {
            foreach ($request->file('images') as $image) {
                $project->addMedia($image)->toMediaCollection('client_project_image');
            }
        }

        // check if project created
        if ($project) {
            // GENERATE AN UNIQUE KEY FOR A PROJECT
            /*$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';*/
            $str_result = '1234';
            $tmp_id = substr(str_shuffle($str_result), 0, 4);
            $project_id = $tmp_id . $project->id;

            //$find_project_id = Project::where('project_id', $project_id)->first();

            $data = [
                'project_id' => $project_id,
            ];

            // Notification for Admin
            Notification::create([
                'project_id' => $project_id,
                'type' => 'ProjectCreation',
                'notification_from' => Auth::id(),
                'notification_to_type' => 'admin',
                'notification_from_type' => 'client',
                'message' => 'Client: ' . UserBasicInfo::where('user_id', Auth::id())->first()->first_name . ' een project heeft aangevraagd. Beoordeel het.',
                'status' => 'unseen',
            ]);

            $this->projectService->update($data, $project->id);

            notifier()->success(__('admin/notifier.project_created_successfully'));

        } else {
            notifier()->error(__('admin/notifier.project_cannot_be_created_now'));
        }
        // redirect back
        return redirect()->route('backend.cms.project-pending.show', [$project->id]);
    }
}
