<?php

namespace Modules\Ums\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserWorkInfoStoreRequest;
use Modules\Ums\Http\Requests\UserWorkInfoUpdateRequest;

// datatable...
use Modules\Ums\DataTables\Profile\WorkInfoDataTable;

// services...
use Modules\Ums\Services\UserService;
use Modules\Ums\Services\UserWorkInfoService;

class WorkInfoController extends Controller
{
    /**
     * @var $userWorkInfoService
     */
    protected $userWorkInfoService;

    /**
     * Constructor
     *
     * @param UserWorkInfoService $userWorkInfoService
     */
    public function __construct(UserWorkInfoService $userWorkInfoService)
    {
        $this->userWorkInfoService = $userWorkInfoService;
    }

    /**
     * UserWorkInfo list
     *
     * @param WorkInfoDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(WorkInfoDataTable $datatable)
    {
        return $datatable->render('ums::profile.work_info.index');
    }

    /**
     * Create userWorkInfo
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('ums::profile.work_info.create');
    }


    /**
     * Store userWorkInfo
     *
     * @param UserWorkInfoStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserWorkInfoStoreRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        // create userWorkInfo
        $userWorkInfo = $this->userWorkInfoService->create($data);
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
        return view('ums::profile.work_info.show', compact('userWorkInfo'));
    }

    /**
     * Show userWorkInfo.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
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
        return view('ums::profile.work_info.edit', compact('userWorkInfo'));
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
