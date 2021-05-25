<?php

namespace Modules\Cms\Http\Controllers;

use App\Helpers\PermissionManager;
use App\Http\Controllers\Controller;

// requests...
use App\Notification;
use Modules\Cms\DataTables\AcceptedProjectDataTable;
use Modules\Cms\Http\Requests\ProjectUpdateRequest;

// services...
use Modules\Cms\Services\ProjectCategoryService;
use Modules\Cms\Services\ProjectService;
use Modules\Ums\Entities\User;

class AcceptedProjectController extends Controller
{
    /**
     * @var $projectService
     */
    protected $projectService;
    protected $user;

    /**
     * Constructor
     *
     * @param ProjectService $projectService
     */
    public function __construct(ProjectService $projectService)
    {
        $this->middleware(function ($request, $next) {
            $this->user = User::find(auth()->user()->id);
            if ($this->user->hasRole('admin') || $this->user->hasRole('super_admin'))
                $this->middleware(['permission:approved_project']);
            else {
                $this->middleware(['permission:my_projects']);
            }
            return $next($request);
        });
        $this->projectService = $projectService;
    }

    /**
     * Project list
     *
     * @param AcceptedProjectDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(AcceptedProjectDataTable $datatable)
    {
        return $datatable->render('cms::project.accepted.index');
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
            notifier()->error(__('admin/notifier.project_not_found'));
            // redirect back
            return redirect()->back();
        }

        if (!PermissionManager::hasAcceptedPermission($project)) {
            abort(404);
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

        $companies = $this->projectService->companies($project->company_id);

        // return view
        return view('cms::project.accepted.show', compact('project', 'companies'));
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
            notifier()->error(__('admin/notifier.project_not_found'));
            // redirect back
            return redirect()->back();
        }
        if (!PermissionManager::hasAcceptedPermission($project)) {
            abort(404);
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
            notifier()->error(__('admin/notifier.project_not_found'));
            // redirect back
            return redirect()->back();
        }
        if (!PermissionManager::hasAcceptedPermission($project)) {
            abort(404);
        }
        // update project
        $project = $this->projectService->update($request->all(), $id);
        // upload files
        $project->uploadFiles();
        // check if project updated
        if ($project) {
            // flash notification
            notifier()->success(__('admin/notifier.project_updated_successfully'));
        } else {
            // flash notification
            notifier()->error(__('admin/notifier.project_cannot_be_updated_successfully'));
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
            notifier()->error(__('admin/notifier.project_not_found'));
            // redirect back
            return redirect()->back();
        }
        if (!PermissionManager::hasAcceptedPermission($project)) {
            abort(404);
        }
        // delete project
        if ($this->projectService->delete($id)) {
            // flash notification
            notifier()->success(__('admin/notifier.project_deleted_successfully'));
        } else {
            // flash notification
            notifier()->success(__('admin/notifier.project_cannot_be_deleted_successfully'));
        }
        // redirect back
        return redirect()->back();
    }
}
