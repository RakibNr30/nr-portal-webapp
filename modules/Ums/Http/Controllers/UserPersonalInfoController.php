<?php

namespace Modules\Ums\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Entities\User;
use Modules\Ums\Http\Requests\UserPersonalInfoStoreRequest;
use Modules\Ums\Http\Requests\UserPersonalInfoUpdateRequest;

// datatable...
use Modules\Ums\Datatables\UserPersonalInfoDataTable;

// services...
use Modules\Ums\Services\UserPersonalInfoService;
use Modules\Ums\Services\UserService;

class UserPersonalInfoController extends Controller
{
    /**
     * @var $userPersonalInfoService
     */
    protected $userPersonalInfoService;
    /**
     * @var $userService
     */
    protected $userService;

    /**
     * Constructor
     *
     * @param UserPersonalInfoService $userPersonalInfoService
     * @param UserService $userService
     */
    public function __construct(UserPersonalInfoService $userPersonalInfoService, UserService $userService)
    {
        $this->userPersonalInfoService = $userPersonalInfoService;
        $this->userService = $userService;
    }

    /**
     * UserPersonalInfo list
     *
     * @param UserPersonalInfoDatatable $datatable
     * @return \Illuminate\View\View
     */
    public function index(UserPersonalInfoDatatable $datatable)
    {
        return $datatable->render('ums::user_personal_info.index');
    }

    /**
     * Create userPersonalInfo
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // users
        $users = $this->userService->all();
        // return view
        return view('ums::user_personal_info.create', compact('users'));
    }


    /**
     * Store userPersonalInfo
     *
     * @param UserPersonalInfoStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserPersonalInfoStoreRequest $request)
    {
        // create userPersonalInfo
        $userPersonalInfo = $this->userPersonalInfoService->create($request->all());
        // check if userPersonalInfo created
        if ($userPersonalInfo) {
            // flash notification
            notifier()->success('UserPersonalInfo created successfully.');
        } else {
            // flash notification
            notifier()->error('UserPersonalInfo cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show userPersonalInfo.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get userPersonalInfo
        $userPersonalInfo = $this->userPersonalInfoService->find($id);
        // check if userPersonalInfo doesn't exists
        if (empty($userPersonalInfo)) {
            // flash notification
            notifier()->error('UserPersonalInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_personal_info.show', compact('userPersonalInfo'));
    }

    /**
     * Show userPersonalInfo.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // users
        $users = $this->userService->all();
        // get userPersonalInfo
        $userPersonalInfo = $this->userPersonalInfoService->find($id);
        // check if userPersonalInfo doesn't exists
        if (empty($userPersonalInfo)) {
            // flash notification
            notifier()->error('UserPersonalInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_personal_info.edit', compact('userPersonalInfo', 'users'));
    }

    /**
     * Update userPersonalInfo
     *
     * @param UserPersonalInfoUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserPersonalInfoUpdateRequest $request, $id)
    {
        // get userPersonalInfo
        $userPersonalInfo = $this->userPersonalInfoService->find($id);
        // check if userPersonalInfo doesn't exists
        if (empty($userPersonalInfo)) {
            // flash notification
            notifier()->error('UserPersonalInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // update userPersonalInfo
        $userPersonalInfo = $this->userPersonalInfoService->update($request->all(), $id);
        // check if userPersonalInfo updated
        if ($userPersonalInfo) {
            // flash notification
            notifier()->success('UserPersonalInfo updated successfully.');
        } else {
            // flash notification
            notifier()->error('UserPersonalInfo cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete userPersonalInfo
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get userPersonalInfo
        $userPersonalInfo = $this->userPersonalInfoService->find($id);
        // check if userPersonalInfo doesn't exists
        if (empty($userPersonalInfo)) {
            // flash notification
            notifier()->error('UserPersonalInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // delete userPersonalInfo
        if ($this->userPersonalInfoService->delete($id)) {
            // flash notification
            notifier()->success('UserPersonalInfo deleted successfully.');
        } else {
            // flash notification
            notifier()->success('UserPersonalInfo cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
