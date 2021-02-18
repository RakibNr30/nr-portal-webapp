<?php

namespace Modules\Ums\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\Services\CourseService;
use Modules\Cms\Services\ProgramService;
use Modules\Ums\Http\Requests\UserEducationalInfoStoreRequest;
use Modules\Ums\Http\Requests\UserEducationalInfoUpdateRequest;

// datatable...
use Modules\Ums\Datatables\UserEducationalInfoDataTable;

// services...
use Modules\Ums\Services\UserEducationalInfoService;
use Modules\Ums\Services\UserService;

class UserEducationalInfoController extends Controller
{
    /**
     * @var $userEducationalInfoService
     */
    protected $userEducationalInfoService;

    /**
     * @var $courseService;
     */
    protected $courseService;

    /**
     * @var $programService;
     */
    protected $programService;

    /**
     * @var $userService;
     */
    protected $userService;

    /**
     * Constructor
     *
     * @param UserEducationalInfoService $userEducationalInfoService
     * @param CourseService $courseService
     * @param ProgramService $programService
     * @param UserService $userService
     */
    public function __construct(UserEducationalInfoService $userEducationalInfoService, CourseService $courseService, ProgramService  $programService, UserService $userService)
    {
        $this->userEducationalInfoService = $userEducationalInfoService;
        $this->courseService = $courseService;
        $this->programService = $programService;
        $this->userService =  $userService;
    }

    /**
     * UserEducationalInfo list
     *
     * @param UserEducationalInfoDatatable $datatable
     * @return \Illuminate\View\View
     */
    public function index(UserEducationalInfoDatatable $datatable)
    {
        return $datatable->render('ums::user_educational_info.index');
    }

    /**
     * Create userEducationalInfo
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // programs
        $programs = $this->programService->all();
        // courses
        $courses = $this->courseService->all();
        // users
        $users = $this->userService->all();

        // return view
        return view('ums::user_educational_info.create', compact('courses', 'programs', 'users'));
    }


    /**
     * Store userEducationalInfo
     *
     * @param UserEducationalInfoStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserEducationalInfoStoreRequest $request)
    {
        // create userEducationalInfo
        $userEducationalInfo = $this->userEducationalInfoService->create($request->all());
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
        return view('ums::user_educational_info.show', compact('userEducationalInfo'));
    }

    /**
     * Show userEducationalInfo.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // courses
        $courses = $this->courseService->all();
        // programs
        $programs = $this->programService->all();
        // users
        $users = $this->userService->all();

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
        return view('ums::user_educational_info.edit', compact('userEducationalInfo','courses', 'programs', 'users'));
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
