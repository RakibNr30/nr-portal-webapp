<?php

namespace Modules\Ums\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserSkillStoreRequest;
use Modules\Ums\Http\Requests\UserSkillUpdateRequest;

// datatable...
use Modules\Ums\DataTables\Profile\SkillDataTable;

// services...
use Modules\Ums\Services\UserService;
use Modules\Ums\Services\UserContentService;

class SkillController extends Controller
{
    /**
     * @var $userSkillService
     */
    protected $userSkillService;

    /**
     * Constructor
     *
     * @param UserContentService $userSkillService
     */
    public function __construct(UserContentService $userSkillService)
    {
        $this->userSkillService = $userSkillService;
    }

    /**
     * UserSkill list
     *
     * @param SkillDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(SkillDataTable $datatable)
    {
        return $datatable->render('ums::profile.skill.index');
    }

    /**
     * Create userSkill
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('ums::profile.skill.create');
    }


    /**
     * Store userSkill
     *
     * @param UserSkillStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserSkillStoreRequest $request)
    {
        // get request data
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        // create userSkill
        $userSkill = $this->userSkillService->create($data);
        // check if userSkill created
        if ($userSkill) {
            // flash notification
            notifier()->success('UserSkill created successfully.');
        } else {
            // flash notification
            notifier()->error('UserSkill cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show userSkill.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get userSkill
        $userSkill = $this->userSkillService->find($id);
        // check if userSkill doesn't exists
        if (empty($userSkill)) {
            // flash notification
            notifier()->error('UserSkill not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::profile.skill.show', compact('userSkill'));
    }

    /**
     * Show userSkill.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get userSkill
        $userSkill = $this->userSkillService->find($id);
        // check if userSkill doesn't exists
        if (empty($userSkill)) {
            // flash notification
            notifier()->error('UserSkill not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::profile.skill.edit', compact('userSkill'));
    }

    /**
     * Update userSkill
     *
     * @param UserSkillUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserSkillUpdateRequest $request, $id)
    {
        // get userSkill
        $userSkill = $this->userSkillService->find($id);
        // check if userSkill doesn't exists
        if (empty($userSkill)) {
            // flash notification
            notifier()->error('UserSkill not found!');
            // redirect back
            return redirect()->back();
        }
        // update userSkill
        $userSkill = $this->userSkillService->update($request->all(), $id);
        // check if userSkill updated
        if ($userSkill) {
            // flash notification
            notifier()->success('UserSkill updated successfully.');
        } else {
            // flash notification
            notifier()->error('UserSkill cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete userSkill
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get userSkill
        $userSkill = $this->userSkillService->find($id);
        // check if userSkill doesn't exists
        if (empty($userSkill)) {
            // flash notification
            notifier()->error('UserSkill not found!');
            // redirect back
            return redirect()->back();
        }
        // delete userSkill
        if ($this->userSkillService->delete($id)) {
            // flash notification
            notifier()->success('UserSkill deleted successfully.');
        } else {
            // flash notification
            notifier()->success('UserSkill cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
