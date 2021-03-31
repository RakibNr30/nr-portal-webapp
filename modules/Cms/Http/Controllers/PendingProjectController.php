<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use App\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Cms\DataTables\PendingProjectDataTable;
use Modules\Cms\Http\Requests\ProjectApproveRequest;
use Modules\Cms\Http\Requests\ProjectUpdateRequest;

// services...
use Modules\Cms\Services\ProjectCategoryService;
use Modules\Cms\Services\ProjectService;
use Modules\Ums\Entities\User;
use Modules\Ums\Entities\UserBasicInfo;
use Modules\Ums\Services\UserService;

class PendingProjectController extends Controller
{
    /**
     * @var $projectService
     */
    protected $projectService;

    /**
     * @var $projectService
     */
    protected $userService;

    /**
     * Constructor
     *
     * @param ProjectService $projectService
     * @param UserService $userService
     */
    public function __construct(ProjectService $projectService, UserService $userService)
    {
        $this->projectService = $projectService;
        $this->userService = $userService;
        $this->middleware(['permission:my_project']);
    }

    /**
     * Project list
     *
     * @param PendingProjectDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(PendingProjectDataTable $datatable)
    {
        $user = User::find(auth()->user()->id);

        if ($user->hasRole('company')) {
            return redirect()->route('backend.cms.dashboard.index');
        }

        return $datatable->render('cms::project.pending.index');
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

        $user = User::find(auth()->user()->id);

        if($user->hasRole('admin') || $user->hasRole('super_admin')) {
            Notification::where('notification_to_type', 'admin')
                ->where('project_id', $project->project_id)
                ->where('status', 'unseen')
                ->update(['status' => 'seen']);
        } else {
            Notification::where('notification_to', $user->id)
                ->where('project_id', $project->project_id)
                ->where('status', 'unseen')
                ->update(['status' => 'seen']);
        }

        // companies
        $companies = $this->userService->companies();

        //return $companies;

        // assign companies
        // return $assignCompanies = $project->company_id;
        // return view
        return view('cms::project.pending.show', compact(
            'project', 'companies'
        ));
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

        // companies
        $companies = $this->userService->companies();

        //return $companies;

        // assign companies
        // return $assignCompanies = $project->company_id;
        // return view
        return view('cms::project.pending.edit', compact(
            'project', 'companies'
        ));
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


    /**
     * Update project
     *
     * @param ProjectApproveRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(ProjectApproveRequest $request, $id)
    {
        $data = $request->all();
        $data['company_id'] = array_map('intval', $data['company_id']);
        // get project
        $project = $this->projectService->find($id);
        // check if project doesn't exists
        if (empty($project)) {
            // flash notification
            notifier()->error('Project not found!');
            // redirect back
            return redirect()->back();
        }
        $data['status'] = 1;
        $data['approved_by'] = auth()->user()->id;
        $data['approved_at'] = Carbon::now()->addHours(6);
        // update project
        $project = $this->projectService->update($data, $id);
        // upload files
        $project->uploadFiles();
        // check if project updated
        if ($project) {
            // Notification for Admin
            Notification::create([
                'project_id' => $project->project_id,
                'type' => 'ProjectApproval',
                'notification_from' => auth()->user()->id,
                'notification_to' => $project->author_id,
                'notification_to_type' => 'client',
                'notification_from_type' => 'admin',
                'message' => 'Project #' . $project->project_id . ' has been approved. Check it.',
                'status' => 'unseen',
            ]);

            // Notification for Company
            foreach ($project->company_id as $company_id) {
                Notification::create([
                    'project_id' => $project->project_id,
                    'type' => 'ProjectApproval',
                    'notification_from' => auth()->user()->id,
                    'notification_to' => $company_id,
                    'notification_to_type' => 'company',
                    'notification_from_type' => 'admin',
                    'message' => 'Project #' . $project->project_id . ' has been assigned to you. Check it.',
                    'status' => 'unseen',
                ]);
            }

            // flash notification
            notifier()->success('Project approved successfully.');
        } else {
            // flash notification
            notifier()->error('Project cannot be approved successfully.');
        }
        // redirect back
        return redirect()->route('backend.cms.project-pending.index');
    }
}