<?php

namespace Modules\Ums\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Ums\Services\UserPersonalInfoService;

// requests...
use Modules\Ums\Http\Requests\UserPersonalInfoStoreRequest;
use Modules\Ums\Http\Requests\UserPersonalInfoUpdateRequest;

// resources...
use Modules\Ums\Transformers\UserPersonalInfoResource;

class UserPersonalInfoController extends Controller
{
    /**
     * @var $userPersonalInfoService
     */
    protected $userPersonalInfoService;

    /**
     * Constructor
     *
     * @param UserPersonalInfoService $userPersonalInfoService
     */
    public function __construct(UserPersonalInfoService $userPersonalInfoService)
    {
        $this->userPersonalInfoService = $userPersonalInfoService;
    }

    /**
     * UserPersonalInfo list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all userPersonalInfos
        $userPersonalInfos = $this->userPersonalInfoService->all(request()->get('limit') ?? 0);
        // if no userPersonalInfo found
        if (!count($userPersonalInfos)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('UserPersonalInfo not available.');
        }
        // transform userPersonalInfos
        $userPersonalInfos = UserPersonalInfoResource::collection($userPersonalInfos);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($userPersonalInfos);
    }

    /**
     * Store a userPersonalInfo.
     *
     * @param UserPersonalInfoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPersonalInfoStoreRequest $request)
    {
        // create userPersonalInfo
        $userPersonalInfo = $this->userPersonalInfoService->create($request->all());
        // check if created
        if ($userPersonalInfo) {
            // transform userPersonalInfo
            $userPersonalInfo = UserPersonalInfoResource::make($userPersonalInfo);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('UserPersonalInfo created successfully.')
                ->data($userPersonalInfo);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserPersonalInfo cannot be created.');
        }
    }

    /**
     * Show userPersonalInfo.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get userPersonalInfo
        $userPersonalInfo = $this->userPersonalInfoService->find($id);
        // if no userPersonalInfo found
        if (empty($userPersonalInfo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserPersonalInfo not found.');
        }
        // transform userPersonalInfo
        $userPersonalInfo = UserPersonalInfoResource::make($userPersonalInfo);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('UserPersonalInfo is available.')
            ->data($userPersonalInfo);
    }

    /**
     * Update userPersonalInfo.
     *
     * @param UserPersonalInfoUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserPersonalInfoUpdateRequest $request, $id)
    {
        // get userPersonalInfo
        $userPersonalInfo = $this->userPersonalInfoService->find($id);
        // if no userPersonalInfo found
        if (empty($userPersonalInfo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserPersonalInfo not found.');
        }
        // update userPersonalInfo
        $userPersonalInfo = $this->userPersonalInfoService->update($request->all(), $id);
        // check if updated
        if ($userPersonalInfo) {
            // get updated userPersonalInfo
            $userPersonalInfo = $this->userPersonalInfoService->find($id);
            // transform userPersonalInfo
            $userPersonalInfo = UserPersonalInfoResource::make($userPersonalInfo);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserPersonalInfo updated successfully.')
                ->data($userPersonalInfo);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserPersonalInfo cannot be updated.');
        }
    }

    /**
     * Remove userPersonalInfo.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get userPersonalInfo
        $userPersonalInfo = $this->userPersonalInfoService->find($id);
        // if no userPersonalInfo found
        if (empty($userPersonalInfo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserPersonalInfo not found.');
        }
        // delete userPersonalInfo
        if ($this->userPersonalInfoService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserPersonalInfo deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserPersonalInfo cannot be deleted.');
        }
    }
}
