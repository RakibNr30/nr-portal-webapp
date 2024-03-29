<?php

namespace Modules\Ums\Http\Controllers;

use App\Helpers\AuthManager;
use App\Helpers\PermissionManager;
use App\Http\Controllers\Controller;

// requests...
use Carbon\Carbon;
use Modules\Cms\Services\ProjectService;
use Modules\Ums\Http\Requests\ClientRequestUpdateRequest;
use Modules\Ums\Http\Requests\UserUpdateRequest;

// datatable...
use Modules\Ums\DataTables\ClientApprovedDataTable;

// services...
use Modules\Ums\Services\RoleService;
use Modules\Ums\Services\UserBasicInfoService;
use Modules\Ums\Services\UserResidentialInfoService;
use Modules\Ums\Services\UserService;
use function GuzzleHttp\Promise\all;

class ClientApprovedController extends Controller
{
    /**
     * @var $userService
     */
    protected $userService;

    /**
     * @var $basicInfoService
     */
    protected $userBasicInfoService;

    /**
     * @var $roleService
     */
    protected $roleService;

    /**
     * @var $basicInfoService
     */
    protected $userResidentialInfoService;

    /**
     * @var $basicInfoService
     */
    protected $projectService;

    /**
     * Constructor
     *
     * @param UserService $userService
     * @param UserBasicInfoService $userBasicInfoService
     * @param RoleService $roleService
     * @param UserResidentialInfoService $userResidentialInfoService
     * @param ProjectService $projectService
     */
    public function __construct(
        UserService $userService,
        UserBasicInfoService $userBasicInfoService,
        RoleService $roleService,
        UserResidentialInfoService $userResidentialInfoService,
        ProjectService $projectService
    )
    {
        $this->userService = $userService;
        $this->userBasicInfoService = $userBasicInfoService;
        $this->roleService = $roleService;
        $this->userResidentialInfoService = $userResidentialInfoService;
        $this->projectService = $projectService;
        //$this->middleware(['permission:user_controls']);
    }

    /**
     * Company list
     *
     * @param ClientApprovedDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(ClientApprovedDataTable $datatable)
    {
        if (!AuthManager::isAdmin()) {
            abort(404);
        }
        return $datatable->render('ums::client.approved.index');
    }

    /**
     * Show user.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get user
        $user = $this->userService->find($id);

        // check if user doesn't exists
        if (empty($user)) {
            // flash notification
            notifier()->error(__('admin/notifier.client_not_found'));
            // redirect back
            return redirect()->back();
        }
        // given roles
        $givenRoles = $user->roles->pluck('name')->toArray();
        // check role
        if (!in_array('client', $givenRoles)) {
            return redirect()->to('/');
        }

        $projects = $this->projectService->findByAuthor($user->id, 5);
        $totalProjects = $this->projectService->findByAuthorAll($user->id);

        // return view
        return view('ums::client.approved.show', compact('user', 'projects', 'totalProjects'));
    }

    /**
     * Show user.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        if (!AuthManager::isAdmin()) {
            abort(404);
        }
        // get user
        $user = $this->userService->find($id);
        // check if user doesn't exists
        if (empty($user)) {
            // flash notification
            notifier()->error(__('admin/notifier.client_not_found'));
            // redirect back
            return redirect()->back();
        }
        // given roles
        $givenRoles = $user->roles->pluck('name')->toArray();
        // check role
        if (!in_array('client', $givenRoles)) {
            return redirect()->to('/');
        }
        // return view
        return view('ums::client.approved.edit', compact('user'));
    }

    /**
     * Update user
     *
     * @param ClientRequestUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ClientRequestUpdateRequest $request, $id)
    {
        if (!AuthManager::isAdmin()) {
            abort(404);
        }
        // get user
        $user = $this->userService->find($id);
        // check if user doesn't exists
        if (empty($user)) {
            // flash notification
            notifier()->error(__('admin/notifier.client_not_found'));
            // redirect back
            return redirect()->back();
        }
        // get data
        $data = $request->all();
        // upload files
        $user->uploadFiles();
        // update user
        $user = $this->userService->update($data, $id);
        // check if user updated
        if ($user) {
            $data['personal_email'] = $user->email;
            $data['personal_phone'] = $user->phone;
            $data['user_id'] = $user->id;
            $data['first_name'] = $data['full_name'];
            $data['about'] = $data['description'];
            $data['personal_email'] = $user->email;
            $data['phone_no'] = $user->phone;
            $data['present_street_name'] = $data['street_name'];
            $data['present_house_number'] = $data['house_number'];
            $data['present_zip_code'] = $data['zip_code'];
            $data['present_city'] = $data['city'];
            $basicInfo = $this->userBasicInfoService->updateOrCreate(['user_id' => $user->id], $data);
            $residentialInfo = $this->userResidentialInfoService->updateOrCreate(['user_id' => $user->id], $data);
            // upload files
            $basicInfo->uploadFiles();
            if ($basicInfo && $residentialInfo) {
                // flash notification
                notifier()->success(__('admin/notifier.client_updated_successfully'));
            } else {
                // flash notification
                notifier()->error(__('admin/notifier.client_cannot_be_updated_successfully'));
            }
        } else {
            // flash notification
            notifier()->error(__('admin/notifier.client_cannot_be_updated_successfully'));
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete user
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (!AuthManager::isAdmin()) {
            abort(404);
        }
        // get user
        $user = $this->userService->find($id);
        // check if user doesn't exists
        if (empty($user)) {
            // flash notification
            notifier()->error(__('admin/notifier.client_not_found'));
            // redirect back
            return redirect()->back();
        }
        // delete user
        if ($this->userService->delete($id)) {
            // flash notification
            notifier()->success(__('admin/notifier.client_deleted_successfully'));
        } else {
            // flash notification
            notifier()->success(__('admin/notifier.client_cannot_be_deleted_successfully'));
        }
        // redirect back
        return redirect()->back();
    }
}
