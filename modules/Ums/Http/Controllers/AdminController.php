<?php

namespace Modules\Ums\Http\Controllers;

use App\Helpers\MailManager;
use App\Http\Controllers\Controller;

// requests...
use Carbon\Carbon;
use Modules\Ums\Entities\User;
use Modules\Ums\Http\Requests\UserStoreRequest;
use Modules\Ums\Http\Requests\UserUpdateRequest;

// datatable...
use Modules\Ums\Datatables\AdminDataTable;

// services...
use Modules\Ums\Services\RoleService;
use Modules\Ums\Services\UserBasicInfoService;
use Modules\Ums\Services\UserService;
use function GuzzleHttp\Promise\all;

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

            MailManager::send($mail_data['email'], $mail_data);
            // upload files
            $basicInfo->uploadFiles();
            if ($basicInfo) {
                // flash notification
                notifier()->success('Admin created successfully.');
            } else {
                // flash notification
                notifier()->error('Admin cannot be created successfully.');
            }
        } else {
            // flash notification
            notifier()->error('Admin cannot be created successfully.');
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
            notifier()->error('Admin not found!');
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
            notifier()->error('Admin not found!');
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
            notifier()->error('Admin not found!');
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
                notifier()->success('Admin updated successfully.');
            } else {
                // flash notification
                notifier()->error('Admin cannot be updated successfully.');
            }
        } else {
            // flash notification
            notifier()->error('Admin cannot be updated successfully.');
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
            notifier()->error('Admin not found!');
            // redirect back
            return redirect()->back();
        }
        // delete user
        if ($this->userService->delete($id)) {
            // flash notification
            notifier()->success('Admin deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Admin cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
