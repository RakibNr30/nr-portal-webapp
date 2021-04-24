<?php

namespace Modules\Ums\Http\Controllers;

use App\Helpers\MailManager;
use App\Http\Controllers\Controller;

// requests...
use Carbon\Carbon;
use Modules\Cms\Services\ProjectService;
use Modules\Ums\Http\Requests\CompanyStoreRequest;
use Modules\Ums\Http\Requests\CompanyUpdateRequest;
use Modules\Ums\Http\Requests\UserStoreRequest;
use Modules\Ums\Http\Requests\UserUpdateRequest;

// datatable...
use Modules\Ums\DataTables\CompanyDataTable;

// services...
use Modules\Ums\Services\RoleService;
use Modules\Ums\Services\UserBasicInfoService;
use Modules\Ums\Services\UserService;
use function GuzzleHttp\Promise\all;

class CompanyController extends Controller
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
    protected $projectService;

    /**
     * Constructor
     *
     * @param UserService $userService
     * @param UserBasicInfoService $userBasicInfoService
     * @param RoleService $roleService
     * @param ProjectService $projectService
     */
    public function __construct(
        UserService $userService,
        UserBasicInfoService $userBasicInfoService,
        RoleService $roleService,
        ProjectService $projectService
    )
    {
        $this->userService = $userService;
        $this->userBasicInfoService = $userBasicInfoService;
        $this->roleService = $roleService;
        $this->projectService = $projectService;
        $this->middleware(['permission:user_controls']);
    }

    /**
     * Company list
     *
     * @param CompanyDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(CompanyDatatable $datatable)
    {
        return $datatable->render('ums::company.index');
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
        return view('ums::company.create', compact('roles'));
    }


    /**
     * Store user
     *
     * @param CompanyStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CompanyStoreRequest $request)
    {
        // get data
        $data = $request->all();

        $str_result_pass = '0123456789abcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!"#$%&\'()*+,-./:;<=>?@[\]^_`{|}~';
        $tmp_pass = substr(str_shuffle($str_result_pass), 0, 10);
        $password = $tmp_pass;

        $mail_data = [
            'mail_category_id' => 3,
            'password' => $password,
            'email' => $data['email']
        ];
        $data['password'] = bcrypt($password);
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
            $data['first_name'] = $data['company_name'];
            $basicInfo = $this->userBasicInfoService->create($data);

            MailManager::send($mail_data['email'], $mail_data);

            // upload files
            $basicInfo->uploadFiles();
            if ($basicInfo) {
                // flash notification
                notifier()->success('Company created successfully.');
            } else {
                // flash notification
                notifier()->error('Company cannot be created successfully.');
            }
        } else {
            // flash notification
            notifier()->error('Company cannot be created successfully.');
        }
        // redirect back
        return redirect()->route('backend.ums.company.index');
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
            notifier()->error('Company not found!');
            // redirect back
            return redirect()->back();
        }
        // given roles
        $givenRoles = $user->roles->pluck('name')->toArray();
        // check role
        if (!in_array('company', $givenRoles)) {
            return redirect()->to('/');
        }
        $projects = $this->projectService->findByCompany($user->id, 5);
        $totalProjects = $this->projectService->findByCompanyAll($user->id);

        // return view
        return view('ums::company.show', compact('user', 'givenRoles', 'projects', 'totalProjects'));
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
            notifier()->error('Company not found!');
            // redirect back
            return redirect()->back();
        }
        // roles
        $roles = $this->roleService->all();
        // given roles
        $givenRoles = $user->roles->pluck('name')->toArray();
        // check role
        if (!in_array('company', $givenRoles)) {
            return redirect()->to('/');
        }
        // return view
        return view('ums::company.edit', compact('user', 'roles', 'givenRoles'));
    }

    /**
     * Update user
     *
     * @param CompanyUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CompanyUpdateRequest $request, $id)
    {
        // get user
        $user = $this->userService->find($id);
        // check if user doesn't exists
        if (empty($user)) {
            // flash notification
            notifier()->error('Company not found!');
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
            $data['first_name'] = $data['company_name'];
            $basicInfo = $this->userBasicInfoService->updateOrCreate(['user_id' => $user->id], $data);
            // upload files
            $basicInfo->uploadFiles();
            if ($basicInfo) {
                // flash notification
                notifier()->success('Company updated successfully.');
            } else {
                // flash notification
                notifier()->error('Company cannot be updated successfully.');
            }
        } else {
            // flash notification
            notifier()->error('Company cannot be updated successfully.');
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
            notifier()->error('Company not found!');
            // redirect back
            return redirect()->back();
        }
        // delete user
        if ($this->userService->delete($id)) {
            // flash notification
            notifier()->success('Company deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Company cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
