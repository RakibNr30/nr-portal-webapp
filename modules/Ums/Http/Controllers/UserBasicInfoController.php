<?php

namespace Modules\Ums\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Entities\User;
use Modules\Ums\Http\Requests\UserBasicInfoStoreRequest;
use Modules\Ums\Http\Requests\UserBasicInfoUpdateRequest;

// datatable...
use Modules\Ums\Datatables\UserBasicInfoDataTable;

// services...
use Modules\Ums\Services\UserBasicInfoService;
use Modules\Ums\Services\UserService;

class UserBasicInfoController extends Controller
{
    /**
     * @var $userBasicInfoService
     */
    protected $userBasicInfoService;
    /**
     * @var $userService
     */
    protected $userService;

    /**
     * Constructor
     *
     * @param UserBasicInfoService $userBasicInfoService
     * @param UserService $userService
     */
    public function __construct(UserBasicInfoService $userBasicInfoService, UserService $userService)
    {
        $this->userBasicInfoService = $userBasicInfoService;
        $this->userService = $userService;
        $this->middleware(['permission:core_settings']);
    }

    /**
     * UserBasicInfo list
     *
     * @param UserBasicInfoDatatable $datatable
     * @return \Illuminate\View\View
     */
    public function index(UserBasicInfoDatatable $datatable)
    {
        return $datatable->render('ums::user_basic_info.index');
    }

    /**
     * Create userBasicInfo
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // users
        $users = $this->userService->all();
        // return view
        return view('ums::user_basic_info.create', compact('users'));
    }


    /**
     * Store userBasicInfo
     *
     * @param UserBasicInfoStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserBasicInfoStoreRequest $request)
    {
        // create userBasicInfo
        $userBasicInfo = $this->userBasicInfoService->create($request->all());
        // check if userBasicInfo created
        if ($userBasicInfo) {
            // flash notification
            notifier()->success('UserBasicInfo created successfully.');
        } else {
            // flash notification
            notifier()->error('UserBasicInfo cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show userBasicInfo.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get userBasicInfo
        $userBasicInfo = $this->userBasicInfoService->find($id);
        // check if userBasicInfo doesn't exists
        if (empty($userBasicInfo)) {
            // flash notification
            notifier()->error('UserBasicInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_basic_info.show', compact('userBasicInfo'));
    }

    /**
     * Show userBasicInfo.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // users
        $users = $this->userService->all();
        // get userBasicInfo
        $userBasicInfo = $this->userBasicInfoService->find($id);
        // check if userBasicInfo doesn't exists
        if (empty($userBasicInfo)) {
            // flash notification
            notifier()->error('UserBasicInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_basic_info.edit', compact('userBasicInfo', 'users'));
    }

    /**
     * Update userBasicInfo
     *
     * @param UserBasicInfoUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserBasicInfoUpdateRequest $request, $id)
    {
        // get userBasicInfo
        $userBasicInfo = $this->userBasicInfoService->find($id);
        // check if userBasicInfo doesn't exists
        if (empty($userBasicInfo)) {
            // flash notification
            notifier()->error('UserBasicInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // update userBasicInfo
        $userBasicInfo = $this->userBasicInfoService->update($request->all(), $id);
        // check if userBasicInfo updated
        if ($userBasicInfo) {
            // flash notification
            notifier()->success('UserBasicInfo updated successfully.');
        } else {
            // flash notification
            notifier()->error('UserBasicInfo cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete userBasicInfo
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get userBasicInfo
        $userBasicInfo = $this->userBasicInfoService->find($id);
        // check if userBasicInfo doesn't exists
        if (empty($userBasicInfo)) {
            // flash notification
            notifier()->error('UserBasicInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // delete userBasicInfo
        if ($this->userBasicInfoService->delete($id)) {
            // flash notification
            notifier()->success('UserBasicInfo deleted successfully.');
        } else {
            // flash notification
            notifier()->success('UserBasicInfo cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
