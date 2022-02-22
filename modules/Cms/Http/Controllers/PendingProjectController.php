<?php

namespace Modules\Cms\Http\Controllers;

use App\Helpers\AuthManager;
use App\Helpers\MailManager;
use App\Helpers\PermissionManager;
use App\Http\Controllers\Controller;

// requests...
use App\Notification;
use Carbon\Carbon;
use Modules\Cms\DataTables\PendingProjectDataTable;
use Modules\Cms\Http\Requests\ProjectApproveRequest;
use Modules\Cms\Http\Requests\ProjectUpdateRequest;

// services...
use Modules\Cms\Services\ProjectCategoryService;
use Modules\Cms\Services\ProjectService;
use Modules\Ums\Entities\User;
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
    protected $user;

    /**
     * Constructor
     *
     * @param ProjectService $projectService
     * @param UserService $userService
     */
    public function __construct(ProjectService $projectService, UserService $userService)
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
        $this->userService = $userService;
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
            notifier()->error(__('admin/notifier.project_not_found'));
            // redirect back
            return redirect()->back();
        }

        if (!PermissionManager::hasPendingPermission($project)) {
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

        // companies
        $companies = $this->userService->companies();

        //return $companies;

        // assign companies
        // return $assignCompanies = $project->company_id;

        $author = $this->userService->find($project->author_id);

        // return view
        return view('cms::project.pending.show', compact(
            'project', 'companies', 'author'
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
            notifier()->error(__('admin/notifier.project_not_found'));
            // redirect back
            return redirect()->back();
        }

        if (!PermissionManager::hasPendingPermission($project)) {
            abort(404);
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
            notifier()->error(__('admin/notifier.project_not_found'));
            // redirect back
            return redirect()->back();
        }

        if (!PermissionManager::hasPendingPermission($project)) {
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

        if (!PermissionManager::hasPendingPermission($project)) {
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


    /**
     * Update project
     *
     * @param ProjectApproveRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(ProjectApproveRequest $request, $id)
    {
        if (!AuthManager::isAdmin()) {
            abort(404);
        }

        $data = $request->all();
        $data['company_id'] = array_map('intval', $data['company_id']);
        // get project
        $project = $this->projectService->find($id);
        // check if project doesn't exists
        if (empty($project)) {
            // flash notification
            notifier()->error(__('admin/notifier.project_not_found'));
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
            // Notification for Client
            Notification::create([
                'project_id' => $project->project_id,
                'type' => 'ProjectApproval',
                'notification_from' => auth()->user()->id,
                'notification_to' => $project->author_id,
                'notification_to_type' => 'client',
                'notification_from_type' => 'admin',
                'message' => 'Project #' . $project->project_id . ' is goedgekeurd. Bekijk het nu.',
                'status' => 'unseen',
            ]);

            $client = User::find($project->author_id);
            $client_mail_data = [
                'mail_category_id' => 4,
                'user_id' => $client->id,
                'project_id' => $project->id,
                'email' => $client->email,
            ];

            try {
                MailManager::send($client_mail_data['email'], $client_mail_data);
            } catch (\Exception $exception) {
                // flash notification
                notifier()->warning(__('admin/notifier.project_approved_successfully_but_email_sending_failed'));
            }

            // Notification for Company
            foreach ($project->company_id as $company_id) {
                Notification::create([
                    'project_id' => $project->project_id,
                    'type' => 'ProjectApproval',
                    'notification_from' => auth()->user()->id,
                    'notification_to' => $company_id,
                    'notification_to_type' => 'company',
                    'notification_from_type' => 'admin',
                    'message' => 'Project #' . $project->project_id . ' is toegewezen aan jullie. Bekijk het nu.',
                    'status' => 'unseen',
                ]);

                $company = User::find($company_id);
                $company_mail_data = [
                    'mail_category_id' => 5,
                    'user_id' => $company->id,
                    'project_id' => $project->id,
                    'email' => $company->email,
                ];

                try {
                    MailManager::send($company_mail_data['email'], $company_mail_data);
                } catch (\Exception $exception) {
                    // flash notification
                    notifier()->warning(__('admin/notifier.project_approved_successfully_but_email_sending_failed'));
                }
            }

            // flash notification
            notifier()->success(__('admin/notifier.project_approved_successfully'));
        } else {
            // flash notification
            notifier()->error(__('admin/notifier.project_cannot_be_approved_successfully'));
        }
        // redirect back
        return redirect()->route('backend.cms.project-approved.show', [$project->id]);
    }
}
