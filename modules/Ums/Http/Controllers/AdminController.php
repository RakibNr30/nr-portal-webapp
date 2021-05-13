<?php

namespace Modules\Ums\Http\Controllers;

use App\Helpers\MailManager;
use App\Http\Controllers\Controller;

// requests...
use Carbon\Carbon;
use Modules\Ums\Http\Requests\UserStoreRequest;
use Modules\Ums\Http\Requests\UserUpdateRequest;

// datatable...
use Modules\Ums\DataTables\AdminDataTable;

// services...
use Modules\Ums\Services\RoleService;
use Modules\Ums\Services\UserBasicInfoService;
use Modules\Ums\Services\UserService;

class AdminController extends Controller
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
     * Constructor
     *
     * @param UserService $userService
     * @param UserBasicInfoService $userBasicInfoService
     * @param RoleService $roleService
     */
    public function __construct(UserService $userService, UserBasicInfoService $userBasicInfoService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->userBasicInfoService = $userBasicInfoService;
        $this->roleService = $roleService;
        $this->middleware(['permission:user_controls']);
    }

    /**
     * Admin list
     *
     * @param AdminDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(AdminDatatable $datatable)
    {
        return $datatable->render('ums::admin.index');
    }

    /**
     * Create user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // roles
        $roles = $this->roleService->all();
        // return view
        return view('ums::admin.create', compact('roles'));
    }


    /**
     * Store user
     *
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserStoreRequest $request)
    {
        // get data
        $data = $request->all();
        $mail_data = [
            'mail_category_id' => 2,
            'password' => $data['password'],
            'email' => $data['email']
        ];
        $data['password'] = bcrypt($data['password']);
        $data['approved_at'] = Carbon::now();
        $data['approved_by'] = auth()->user()->id;
        $roles = $data['roles'];
        // insert role to user table
        $data['role'] = $roles[0];
        // create user
        $user = $this->userService->create($data);
        // assign roles
        $user->assignRole($roles);
        // upload files
        $user->uploadFiles();
        // check if user created
        if ($user) {
            $mail_data['user_id'] = $user->id;

            $data['user_id'] = $user->id;
            $data['personal_email'] = $user->email;
            $data['personal_phone'] = $user->phone;
            $basicInfo = $this->userBasicInfoService->create($data);

            // upload files
            $basicInfo->uploadFiles();
            if ($basicInfo) {
                // flash notification
                notifier()->success(__('admin/notifier.admin_created_successfully'));
                try {
                    MailManager::send($mail_data['email'], $mail_data);
                } catch (\Exception $exception) {
                    // flash notification
                    notifier()->warning(__('admin/notifier.admin_created_successfully_but_email_sending_failed'));
                }
            } else {
                // flash notification
                notifier()->error(__('admin/notifier.admin_cannot_be_created_successfully'));
            }
        } else {
            // flash notification
            notifier()->error(__('admin/notifier.admin_cannot_be_created_successfully'));
        }
        // redirect back
        return redirect()->back();
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
            notifier()->error(__('admin/notifier.admin_not_found'));
            // redirect back
            return redirect()->back();
        }
        // given roles
        $givenRoles = $user->roles->pluck('name')->toArray();
        // check role
        if (!in_array('admin', $givenRoles)) {
            return redirect()->to('/');
        }

        // return view
        return view('ums::admin.show', compact('user', 'givenRoles'));
    }

    /**
     * Show user.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get user
        $user = $this->userService->find($id);
        // check if user doesn't exists
        if (empty($user)) {
            // flash notification
            notifier()->error(__('admin/notifier.admin_not_found'));
            // redirect back
            return redirect()->back();
        }
        // roles
        $roles = $this->roleService->all();
        // given roles
        $givenRoles = $user->roles->pluck('name')->toArray();
        // check role
        if (!in_array('admin', $givenRoles)) {
            return redirect()->to('/');
        }
        // return view
        return view('ums::admin.edit', compact('user', 'roles', 'givenRoles'));
    }

    /**
     * Update user
     *
     * @param UserUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        // get user
        $user = $this->userService->find($id);
        // check if user doesn't exists
        if (empty($user)) {
            // flash notification
            notifier()->error(__('admin/notifier.admin_not_found'));
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
            $basicInfo = $this->userBasicInfoService->updateOrCreate(['user_id' => $user->id], $data);
            // upload files
            $basicInfo->uploadFiles();
            if ($basicInfo) {
                // flash notification
                notifier()->success(__('admin/notifier.admin_updated_successfully'));
            } else {
                // flash notification
                notifier()->error(__('admin/notifier.admin_cannot_be_updated_successfully'));
            }
        } else {
            // flash notification
            notifier()->error(__('admin/notifier.admin_cannot_be_updated_successfully'));
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
        // get user
        $user = $this->userService->find($id);
        // check if user doesn't exists
        if (empty($user)) {
            // flash notification
            notifier()->error(__('admin/notifier.admin_not_found'));
            // redirect back
            return redirect()->back();
        }
        // delete user
        if ($this->userService->delete($id)) {
            // flash notification
            notifier()->success(__('admin/notifier.admin_deleted_successfully'));
        } else {
            // flash notification
            notifier()->success(__('admin/notifier.admin_cannot_be_deleted_successfully'));
        }
        // redirect back
        return redirect()->back();
    }
}
