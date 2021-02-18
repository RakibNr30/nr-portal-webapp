<?php

namespace Modules\Ums\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserWorkInfoStoreRequest;
use Modules\Ums\Http\Requests\UserWorkInfoUpdateRequest;

// datatable...
use Modules\Ums\Datatables\UserWorkInfoDataTable;

// services...
use Modules\Ums\Services\UserService;
use Modules\Ums\Services\UserWorkInfoService;

class UserWorkInfoController extends Controller
{
    /**
     * @var $userWorkInfoService
     */
    protected $userWorkInfoService;
    /**
     * @var $userService
     */
    protected $userService;

    /**
     * Constructor
     *
     * @param UserWorkInfoService $userWorkInfoService
     * @param UserService $userService
     */
    public function __construct(UserWorkInfoService $userWorkInfoService, UserService $userService)
    {
        $this->userWorkInfoService = $userWorkInfoService;
        $this->userService = $userService;
    }

    /**
     * UserWorkInfo list
     *
     * @param UserWorkInfoDatatable $datatable
     * @return \Illuminate\View\View
     */
    public function index(UserWorkInfoDatatable $datatable)
    {
        return $datatable->render('ums::user_work_info.index');
    }

    /**
     * Create userWorkInfo
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // users
        $users = $this->userService->all();
        // return view
        return view('ums::user_work_info.create', compact('users'));
    }


    /**
     * Store userWorkInfo
     *
     * @param UserWorkInfoStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserWorkInfoStoreRequest $request)
    {
        // create userWorkInfo
        $userWorkInfo = $this->userWorkInfoService->create($request->all());
        // check if userWorkInfo created
        if ($userWorkInfo) {
            // flash notification
            notifier()->success('UserWorkInfo created successfully.');
        } else {
            // flash notification
            notifier()->error('UserWorkInfo cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show userWorkInfo.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get userWorkInfo
        $userWorkInfo = $this->userWorkInfoService->find($id);
        // check if userWorkInfo doesn't exists
        if (empty($userWorkInfo)) {
            // flash notification
            notifier()->error('UserWorkInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_work_info.show', compact('userWorkInfo'));
    }

    /**
     * Show userWorkInfo.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // users
        $users = $this->userService->all();
        // get userWorkInfo
        $userWorkInfo = $this->userWorkInfoService->find($id);
        // check if userWorkInfo doesn't exists
        if (empty($userWorkInfo)) {
            // flash notification
            notifier()->error('UserWorkInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_work_info.edit', compact('userWorkInfo','users'));
    }

    /**
     * Update userWorkInfo
     *
     * @param UserWorkInfoUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserWorkInfoUpdateRequest $request, $id)
    {
        // get userWorkInfo
        $userWorkInfo = $this->userWorkInfoService->find($id);
        // check if userWorkInfo doesn't exists
        if (empty($userWorkInfo)) {
            // flash notification
            notifier()->error('UserWorkInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // update userWorkInfo
        $userWorkInfo = $this->userWorkInfoService->update($request->all(), $id);
        // check if userWorkInfo updated
        if ($userWorkInfo) {
            // flash notification
            notifier()->success('UserWorkInfo updated successfully.');
        } else {
            // flash notification
            notifier()->error('UserWorkInfo cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete userWorkInfo
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get userWorkInfo
        $userWorkInfo = $this->userWorkInfoService->find($id);
        // check if userWorkInfo doesn't exists
        if (empty($userWorkInfo)) {
            // flash notification
            notifier()->error('UserWorkInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // delete userWorkInfo
        if ($this->userWorkInfoService->delete($id)) {
            // flash notification
            notifier()->success('UserWorkInfo deleted successfully.');
        } else {
            // flash notification
            notifier()->success('UserWorkInfo cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
