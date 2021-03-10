<?php

namespace Modules\Ums\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserResidentialInfoStoreRequest;
use Modules\Ums\Http\Requests\UserResidentialInfoUpdateRequest;

// datatable...
use Modules\Ums\Datatables\UserResidentialInfoDataTable;

// services...
use Modules\Ums\Services\UserResidentialInfoService;
use Modules\Ums\Services\UserService;

class UserResidentialInfoController extends Controller
{
    /**
     * @var $userResidentialInfoService
     */
    protected $userResidentialInfoService;
    /**
     * @var $userService
     */
    protected $userService;

    /**
     * Constructor
     *
     * @param UserResidentialInfoService $userResidentialInfoService
     * @param UserService $userService
     */
    public function __construct(UserResidentialInfoService $userResidentialInfoService, UserService $userService)
    {
        $this->userResidentialInfoService = $userResidentialInfoService;
        $this->userService = $userService;
        $this->middleware(['permission:core_settings']);
    }

    /**
     * UserResidentialInfo list
     *
     * @param UserResidentialInfoDatatable $datatable
     * @return \Illuminate\View\View
     */
    public function index(UserResidentialInfoDatatable $datatable)
    {
        return $datatable->render('ums::user_residential_info.index');
    }

    /**
     * Create userResidentialInfo
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //users
        $users = $this->userService->all();
        // return view
        return view('ums::user_residential_info.create', compact('users'));
    }


    /**
     * Store userResidentialInfo
     *
     * @param UserResidentialInfoStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserResidentialInfoStoreRequest $request)
    {
        // create userResidentialInfo
        $userResidentialInfo = $this->userResidentialInfoService->create($request->all());
        // check if userResidentialInfo created
        if ($userResidentialInfo) {
            // flash notification
            notifier()->success('UserResidentialInfo created successfully.');
        } else {
            // flash notification
            notifier()->error('UserResidentialInfo cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show userResidentialInfo.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get userResidentialInfo
        $userResidentialInfo = $this->userResidentialInfoService->find($id);
        // check if userResidentialInfo doesn't exists
        if (empty($userResidentialInfo)) {
            // flash notification
            notifier()->error('UserResidentialInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_residential_info.show', compact('userResidentialInfo'));
    }

    /**
     * Show userResidentialInfo.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        //users
        $users = $this->userService->all();
        // get userResidentialInfo
        $userResidentialInfo = $this->userResidentialInfoService->find($id);
        // check if userResidentialInfo doesn't exists
        if (empty($userResidentialInfo)) {
            // flash notification
            notifier()->error('UserResidentialInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_residential_info.edit', compact('userResidentialInfo', 'users'));
    }

    /**
     * Update userResidentialInfo
     *
     * @param UserResidentialInfoUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserResidentialInfoUpdateRequest $request, $id)
    {
        // get userResidentialInfo
        $userResidentialInfo = $this->userResidentialInfoService->find($id);
        // check if userResidentialInfo doesn't exists
        if (empty($userResidentialInfo)) {
            // flash notification
            notifier()->error('UserResidentialInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // update userResidentialInfo
        $userResidentialInfo = $this->userResidentialInfoService->update($request->all(), $id);
        // check if userResidentialInfo updated
        if ($userResidentialInfo) {
            // flash notification
            notifier()->success('UserResidentialInfo updated successfully.');
        } else {
            // flash notification
            notifier()->error('UserResidentialInfo cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete userResidentialInfo
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get userResidentialInfo
        $userResidentialInfo = $this->userResidentialInfoService->find($id);
        // check if userResidentialInfo doesn't exists
        if (empty($userResidentialInfo)) {
            // flash notification
            notifier()->error('UserResidentialInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // delete userResidentialInfo
        if ($this->userResidentialInfoService->delete($id)) {
            // flash notification
            notifier()->success('UserResidentialInfo deleted successfully.');
        } else {
            // flash notification
            notifier()->success('UserResidentialInfo cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
