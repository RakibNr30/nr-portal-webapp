<?php

namespace Modules\Ums\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserInterestStoreRequest;
use Modules\Ums\Http\Requests\UserInterestUpdateRequest;

// datatable...
use Modules\Ums\Datatables\UserInterestDataTable;

// services...
use Modules\Ums\Services\UserInterestService;
use Modules\Ums\Services\UserService;

class UserInterestController extends Controller
{
    /**
     * @var $userInterestService
     */
    protected $userInterestService;
    /**
     * @var $userService
     */
    protected $userService;

    /**
     * Constructor
     *
     * @param UserInterestService $userInterestService
     * @param UserService $userService
     */
    public function __construct(UserInterestService $userInterestService, UserService $userService)
    {
        $this->userInterestService = $userInterestService;
        $this->userService = $userService;
    }

    /**
     * UserInterest list
     *
     * @param UserInterestDatatable $datatable
     * @return \Illuminate\View\View
     */
    public function index(UserInterestDatatable $datatable)
    {
        return $datatable->render('ums::user_interest.index');
    }

    /**
     * Create userInterest
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //users
        $users = $this->userService->all();
        // return view
        return view('ums::user_interest.create', compact('users'));
    }


    /**
     * Store userInterest
     *
     * @param UserInterestStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserInterestStoreRequest $request)
    {
        // create userInterest
        $userInterest = $this->userInterestService->create($request->all());
        // check if userInterest created
        if ($userInterest) {
            // flash notification
            notifier()->success('UserInterest created successfully.');
        } else {
            // flash notification
            notifier()->error('UserInterest cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show userInterest.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get userInterest
        $userInterest = $this->userInterestService->find($id);
        // check if userInterest doesn't exists
        if (empty($userInterest)) {
            // flash notification
            notifier()->error('UserInterest not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_interest.show', compact('userInterest'));
    }

    /**
     * Show userInterest.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        //users
        $users = $this->userService->all();
        // get userInterest
        $userInterest = $this->userInterestService->find($id);
        // check if userInterest doesn't exists
        if (empty($userInterest)) {
            // flash notification
            notifier()->error('UserInterest not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_interest.edit', compact('userInterest', 'users'));
    }

    /**
     * Update userInterest
     *
     * @param UserInterestUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserInterestUpdateRequest $request, $id)
    {
        // get userInterest
        $userInterest = $this->userInterestService->find($id);
        // check if userInterest doesn't exists
        if (empty($userInterest)) {
            // flash notification
            notifier()->error('UserInterest not found!');
            // redirect back
            return redirect()->back();
        }
        // update userInterest
        $userInterest = $this->userInterestService->update($request->all(), $id);
        // check if userInterest updated
        if ($userInterest) {
            // flash notification
            notifier()->success('UserInterest updated successfully.');
        } else {
            // flash notification
            notifier()->error('UserInterest cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete userInterest
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get userInterest
        $userInterest = $this->userInterestService->find($id);
        // check if userInterest doesn't exists
        if (empty($userInterest)) {
            // flash notification
            notifier()->error('UserInterest not found!');
            // redirect back
            return redirect()->back();
        }
        // delete userInterest
        if ($this->userInterestService->delete($id)) {
            // flash notification
            notifier()->success('UserInterest deleted successfully.');
        } else {
            // flash notification
            notifier()->success('UserInterest cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
