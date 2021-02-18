<?php

namespace Modules\Ums\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Ums\Services\UserResidentialInfoService;

// requests...
use Modules\Ums\Http\Requests\UserResidentialInfoStoreRequest;
use Modules\Ums\Http\Requests\UserResidentialInfoUpdateRequest;

// resources...
use Modules\Ums\Transformers\UserResidentialInfoResource;

class UserResidentialInfoController extends Controller
{
    /**
     * @var $userResidentialInfoService
     */
    protected $userResidentialInfoService;

    /**
     * Constructor
     *
     * @param UserResidentialInfoService $userResidentialInfoService
     */
    public function __construct(UserResidentialInfoService $userResidentialInfoService)
    {
        $this->userResidentialInfoService = $userResidentialInfoService;
    }

    /**
     * UserResidentialInfo list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all userResidentialInfos
        $userResidentialInfos = $this->userResidentialInfoService->all(request()->get('limit') ?? 0);
        // if no userResidentialInfo found
        if (!count($userResidentialInfos)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('UserResidentialInfo not available.');
        }
        // transform userResidentialInfos
        $userResidentialInfos = UserResidentialInfoResource::collection($userResidentialInfos);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($userResidentialInfos);
    }

    /**
     * Store a userResidentialInfo.
     *
     * @param UserResidentialInfoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserResidentialInfoStoreRequest $request)
    {
        // create userResidentialInfo
        $userResidentialInfo = $this->userResidentialInfoService->create($request->all());
        // check if created
        if ($userResidentialInfo) {
            // transform userResidentialInfo
            $userResidentialInfo = UserResidentialInfoResource::make($userResidentialInfo);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('UserResidentialInfo created successfully.')
                ->data($userResidentialInfo);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserResidentialInfo cannot be created.');
        }
    }

    /**
     * Show userResidentialInfo.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get userResidentialInfo
        $userResidentialInfo = $this->userResidentialInfoService->find($id);
        // if no userResidentialInfo found
        if (empty($userResidentialInfo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserResidentialInfo not found.');
        }
        // transform userResidentialInfo
        $userResidentialInfo = UserResidentialInfoResource::make($userResidentialInfo);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('UserResidentialInfo is available.')
            ->data($userResidentialInfo);
    }

    /**
     * Update userResidentialInfo.
     *
     * @param UserResidentialInfoUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserResidentialInfoUpdateRequest $request, $id)
    {
        // get userResidentialInfo
        $userResidentialInfo = $this->userResidentialInfoService->find($id);
        // if no userResidentialInfo found
        if (empty($userResidentialInfo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserResidentialInfo not found.');
        }
        // update userResidentialInfo
        $userResidentialInfo = $this->userResidentialInfoService->update($request->all(), $id);
        // check if updated
        if ($userResidentialInfo) {
            // get updated userResidentialInfo
            $userResidentialInfo = $this->userResidentialInfoService->find($id);
            // transform userResidentialInfo
            $userResidentialInfo = UserResidentialInfoResource::make($userResidentialInfo);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserResidentialInfo updated successfully.')
                ->data($userResidentialInfo);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserResidentialInfo cannot be updated.');
        }
    }

    /**
     * Remove userResidentialInfo.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get userResidentialInfo
        $userResidentialInfo = $this->userResidentialInfoService->find($id);
        // if no userResidentialInfo found
        if (empty($userResidentialInfo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserResidentialInfo not found.');
        }
        // delete userResidentialInfo
        if ($this->userResidentialInfoService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserResidentialInfo deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserResidentialInfo cannot be deleted.');
        }
    }
}
