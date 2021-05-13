<?php

namespace Modules\Cms\Http\Controllers;

use App\Helpers\MailManager;
use App\Http\Controllers\Controller;

// requests...
use App\Notification;
use Illuminate\Support\Facades\Auth;
use Modules\Cms\DataTables\ApprovedProjectDataTable;
use Modules\Cms\Http\Requests\ProjectApproveByClientUpdateRequest;
use Modules\Cms\Http\Requests\ProjectFilesUpdateRequest;
use Modules\Cms\Http\Requests\ProjectStoreRequest;
use Modules\Cms\Http\Requests\ProjectUpdateRequest;

// services...
use Modules\Cms\Services\ProjectCategoryService;
use Modules\Cms\Services\ProjectService;
use Modules\Ums\Entities\User;
use Modules\Ums\Entities\UserBasicInfo;

class ApprovedProjectController extends Controller
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
     * @param Auth $auth
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
            notifier()->success(__('admin/notifier.project_created_successfully'));
        } else {
            // flash notification
            notifier()->error(__('admin/notifier.project_cannot_be_created_successfully'));
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
            notifier()->error(__('admin/notifier.project_not_found'));
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
            notifier()->error(__('admin/notifier.project_not_found'));
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
            notifier()->error(__('admin/notifier.project_not_found'));
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
     * @param ProjectFilesUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function filesUpdate(ProjectFilesUpdateRequest $request, $id)
    {
        $currentCompany = $request->all()['file_company_id'];

        // get project
        $project = $this->projectService->find($id);
        // check if project doesn't exists
        if (empty($project)) {
            // flash notification
            notifier()->error(__('admin/notifier.project_not_found'));
            // redirect back
            return redirect()->back()->with('currentCompany', $currentCompany);
        }
        // update project
        $project = $this->projectService->update($request->all(), $id);
        // upload files
        $project->uploadFiles();
        // check if project updated
        if ($project) {
            $user = User::find(auth()->user()->id);

            // Notification for Admin
            if ($user->hasRole('company')) {
                Notification::create([
                    'project_id' => $project->project_id,
                    'type' => 'ProjectCompanyFile',
                    'notification_from' => $user->id,
                    'notification_to_type' => 'admin',
                    'notification_from_type' => 'company',
                    'message' => 'Company: ' . UserBasicInfo::where('user_id', Auth::id())->first()->first_name . ' has uploaded a file on project #' . $project->project_id,
                    'status' => 'unseen',
                ]);
            }
            // Notification for Client
            if ($user->hasRole('admin') || $user->hasRole('super_admin')) {
                Notification::create([
                    'project_id' => $project->project_id,
                    'type' => 'ProjectAdminFile',
                    'notification_from' => $user->id,
                    'notification_to' => $project->author_id,
                    'notification_to_type' => 'client',
                    'notification_from_type' => 'admin',
                    'message' => 'An admin has uploaded a file on your project #' . $project->project_id,
                    'status' => 'unseen',
                ]);

                // Notification for Company
                Notification::create([
                    'project_id' => $project->project_id,
                    'type' => 'ProjectAdminFile',
                    'notification_from' => $user->id,
                    'notification_to' => $request->all()['file_company_id'],
                    'notification_to_type' => 'company',
                    'notification_from_type' => 'admin',
                    'message' => 'An admin has uploaded a file on assigned project #' . $project->project_id,
                    'status' => 'unseen',
                ]);
            }

            // flash notification
            notifier()->success(__('admin/notifier.project_file_uploaded_successfully'));
        } else {
            // flash notification
            notifier()->error(__('admin/notifier.project_file_cannot_be_uploaded_successfully'));
        }

        // redirect back
        return redirect()->back()->with('currentCompany', $currentCompany);
    }

    /**
     * Update project
     *
     * @param ProjectApproveByClientUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveByClient(ProjectApproveByClientUpdateRequest $request, $id)
    {
        $data = $request->all();
        $currentCompany = $data['selected_company_id'];

        // get project
        $project = $this->projectService->find($id);
        // check if project doesn't exists
        if (empty($project)) {
            // flash notification
            notifier()->error(__('admin/notifier.project_not_found'));
            // redirect back
            return redirect()->back()->with('currentCompany', $currentCompany);
        }

        $data['selected_company_id'] = array_map('intval', $data['selected_company_id']);
        $data['company_id'] = $data['selected_company_id'];
        $data['status'] = 2;
        $data['client_approve_status'] = 1;

        // update project
        $project = $this->projectService->update($data, $id);
        // check if project updated
        if ($project) {
            $user = User::find(auth()->user()->id);

            // Notification for company
            Notification::create([
                'project_id' => $project->project_id,
                'type' => 'ProjectClientApproval',
                'notification_from' => $user->id,
                'notification_to' => $data['company_id'][0],
                'notification_to_type' => 'company',
                'notification_from_type' => 'client',
                'message' => 'Client: ' . UserBasicInfo::where('user_id', Auth::id())->first()->first_name . ' has started a assigned project #' . $project->project_id,
                'status' => 'unseen',
            ]);

            $company = User::find($data['company_id'][0]);
            $company_mail_data = [
                'mail_category_id' => 6,
                'user_id' => $company->id,
                'project_id' => $project->id,
                'email' => $company->email,
            ];

            // Notification for admin
            Notification::create([
                'project_id' => $project->project_id,
                'type' => 'ProjectClientApproval',
                'notification_from' => $user->id,
                'notification_to_type' => 'admin',
                'notification_from_type' => 'client',
                'message' => 'Client: ' . UserBasicInfo::where('user_id', Auth::id())->first()->first_name . ' has started a project #' . $project->project_id,
                'status' => 'unseen',
            ]);

            MailManager::send($company_mail_data['email'], $company_mail_data);

            // flash notification
            notifier()->success(__('admin/notifier.project_approved_by_client_successfully'));
            return redirect()->route('backend.cms.project-accepted.index');
        } else {
            // flash notification
            notifier()->error(__('admin/notifier.project_approved_by_client_not_successful'));
        }
        // redirect back
        return redirect()->back()->with('currentCompany', $currentCompany);
    }
}