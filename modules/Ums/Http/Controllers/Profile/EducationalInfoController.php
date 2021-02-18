<?php

namespace Modules\Ums\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserEducationalInfoStoreRequest;
use Modules\Ums\Http\Requests\UserEducationalInfoUpdateRequest;

// datatable...
use Modules\Ums\DataTables\Profile\EducationalInfoDataTable;

// services...
use Modules\Ums\Services\UserEducationalInfoService;

class EducationalInfoController extends Controller
{
    /**
     * @var $userEducationalInfoService
     */
    protected $userEducationalInfoService;

    /**
     * Constructor
     *
     * @param UserEducationalInfoService $userEducationalInfoService
     */
    public function __construct(UserEducationalInfoService $userEducationalInfoService)
    {
        $this->userEducationalInfoService = $userEducationalInfoService;
    }

    /**
     * UserEducationalInfo list
     *
     * @param EducationalInfoDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(EducationalInfoDataTable $datatable)
    {
        return $datatable->render('ums::profile.educational_info.index');
    }

    /**
     * Create userEducationalInfo
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('ums::profile.educational_info.create');
    }


    /**
     * Store userEducationalInfo
     *
     * @param UserEducationalInfoStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserEducationalInfoStoreRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        // create userEducationalInfo
        $userEducationalInfo = $this->userEducationalInfoService->create($data);
        // check if userEducationalInfo created
        if ($userEducationalInfo) {
            // flash notification
            notifier()->success('UserEducationalInfo created successfully.');
        } else {
            // flash notification
            notifier()->error('UserEducationalInfo cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show userEducationalInfo.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get userEducationalInfo
        $userEducationalInfo = $this->userEducationalInfoService->find($id);
        // check if userEducationalInfo doesn't exists
        if (empty($userEducationalInfo)) {
            // flash notification
            notifier()->error('UserEducationalInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::profile.educational_info.show', compact('userEducationalInfo'));
    }

    /**
     * Show userEducationalInfo.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get userEducationalInfo
        $userEducationalInfo = $this->userEducationalInfoService->find($id);
        // check if userEducationalInfo doesn't exists
        if (empty($userEducationalInfo)) {
            // flash notification
            notifier()->error('UserEducationalInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::profile.educational_info.edit', compact('userEducationalInfo'));
    }

    /**
     * Update userEducationalInfo
     *
     * @param UserEducationalInfoUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserEducationalInfoUpdateRequest $request, $id)
    {
        // get userEducationalInfo
        $userEducationalInfo = $this->userEducationalInfoService->find($id);
        // check if userEducationalInfo doesn't exists
        if (empty($userEducationalInfo)) {
            // flash notification
            notifier()->error('UserEducationalInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // update userEducationalInfo
        $userEducationalInfo = $this->userEducationalInfoService->update($request->all(), $id);
        // check if userEducationalInfo updated
        if ($userEducationalInfo) {
            // flash notification
            notifier()->success('UserEducationalInfo updated successfully.');
        } else {
            // flash notification
            notifier()->error('UserEducationalInfo cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete userEducationalInfo
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get userEducationalInfo
        $userEducationalInfo = $this->userEducationalInfoService->find($id);
        // check if userEducationalInfo doesn't exists
        if (empty($userEducationalInfo)) {
            // flash notification
            notifier()->error('UserEducationalInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // delete userEducationalInfo
        if ($this->userEducationalInfoService->delete($id)) {
            // flash notification
            notifier()->success('UserEducationalInfo deleted successfully.');
        } else {
            // flash notification
            notifier()->success('UserEducationalInfo cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
