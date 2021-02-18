<?php

namespace Modules\Ums\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Ums\Services\UserContentService;

// requests...
use Modules\Ums\Http\Requests\UserSkillStoreRequest;
use Modules\Ums\Http\Requests\UserSkillUpdateRequest;

// resources...
use Modules\Ums\Transformers\UserContentResource;

class UserSkillController extends Controller
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
     * UserSkill list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all userSkills
        $userSkills = $this->userSkillService->all(request()->get('limit') ?? 0);
        // if no userSkill found
        if (!count($userSkills)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('UserSkill not available.');
        }
        // transform userSkills
        $userSkills = UserContentResource::collection($userSkills);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($userSkills);
    }

    /**
     * Store a userSkill.
     *
     * @param UserSkillStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserSkillStoreRequest $request)
    {
        // create userSkill
        $userSkill = $this->userSkillService->create($request->all());
        // check if created
        if ($userSkill) {
            // transform userSkill
            $userSkill = UserContentResource::make($userSkill);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('UserSkill created successfully.')
                ->data($userSkill);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserSkill cannot be created.');
        }
    }

    /**
     * Show userSkill.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get userSkill
        $userSkill = $this->userSkillService->find($id);
        // if no userSkill found
        if (empty($userSkill)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserSkill not found.');
        }
        // transform userSkill
        $userSkill = UserContentResource::make($userSkill);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('UserSkill is available.')
            ->data($userSkill);
    }

    /**
     * Update userSkill.
     *
     * @param UserSkillUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserSkillUpdateRequest $request, $id)
    {
        // get userSkill
        $userSkill = $this->userSkillService->find($id);
        // if no userSkill found
        if (empty($userSkill)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserSkill not found.');
        }
        // update userSkill
        $userSkill = $this->userSkillService->update($request->all(), $id);
        // check if updated
        if ($userSkill) {
            // get updated userSkill
            $userSkill = $this->userSkillService->find($id);
            // transform userSkill
            $userSkill = UserContentResource::make($userSkill);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserSkill updated successfully.')
                ->data($userSkill);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserSkill cannot be updated.');
        }
    }

    /**
     * Remove userSkill.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get userSkill
        $userSkill = $this->userSkillService->find($id);
        // if no userSkill found
        if (empty($userSkill)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserSkill not found.');
        }
        // delete userSkill
        if ($this->userSkillService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserSkill deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserSkill cannot be deleted.');
        }
    }
}
