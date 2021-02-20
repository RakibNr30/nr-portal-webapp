<?php

namespace Modules\Ums\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Ums\Services\UserBasicInfoService;

// requests...
use Modules\Ums\Http\Requests\UserBasicInfoStoreRequest;
use Modules\Ums\Http\Requests\UserBasicInfoUpdateRequest;

// resources...
use Modules\Ums\Transformers\UserBasicInfoResource;

class UserBasicInfoController extends Controller
{
    /**
     * @var $userBasicInfoService
     */
    protected $userBasicInfoService;

    /**
     * Constructor
     *
     * @param UserBasicInfoService $userBasicInfoService
     */
    public function __construct(UserBasicInfoService $userBasicInfoService)
    {
        $this->userBasicInfoService = $userBasicInfoService;
    }

    /**
     * UserBasicInfo list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all userBasicInfos
        $userBasicInfos = $this->userBasicInfoService->all(request()->get('limit') ?? 0);
        // if no userBasicInfo found
        if (!count($userBasicInfos)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('UserBasicInfo not available.');
        }
        // transform userBasicInfos
        $userBasicInfos = UserBasicInfoResource::collection($userBasicInfos);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($userBasicInfos);
    }

    /**
     * Store a userBasicInfo.
     *
     * @param UserBasicInfoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserBasicInfoStoreRequest $request)
    {
        // create userBasicInfo
        $userBasicInfo = $this->userBasicInfoService->create($request->all());
        // check if created
        if ($userBasicInfo) {
            // transform userBasicInfo
            $userBasicInfo = UserBasicInfoResource::make($userBasicInfo);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('UserBasicInfo created successfully.')
                ->data($userBasicInfo);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserBasicInfo cannot be created.');
        }
    }

    /**
     * Show userBasicInfo.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get userBasicInfo
        $userBasicInfo = $this->userBasicInfoService->find($id);
        // if no userBasicInfo found
        if (empty($userBasicInfo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserBasicInfo not found.');
        }
        // transform userBasicInfo
        $userBasicInfo = UserBasicInfoResource::make($userBasicInfo);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('UserBasicInfo is available.')
            ->data($userBasicInfo);
    }

    /**
     * Update userBasicInfo.
     *
     * @param UserBasicInfoUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserBasicInfoUpdateRequest $request, $id)
    {
        // get userBasicInfo
        $userBasicInfo = $this->userBasicInfoService->find($id);
        // if no userBasicInfo found
        if (empty($userBasicInfo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserBasicInfo not found.');
        }
        // update userBasicInfo
        $userBasicInfo = $this->userBasicInfoService->update($request->all(), $id);
        // check if updated
        if ($userBasicInfo) {
            // get updated userBasicInfo
            $userBasicInfo = $this->userBasicInfoService->find($id);
            // transform userBasicInfo
            $userBasicInfo = UserBasicInfoResource::make($userBasicInfo);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserBasicInfo updated successfully.')
                ->data($userBasicInfo);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserBasicInfo cannot be updated.');
        }
    }

    /**
     * Remove userBasicInfo.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get userBasicInfo
        $userBasicInfo = $this->userBasicInfoService->find($id);
        // if no userBasicInfo found
        if (empty($userBasicInfo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserBasicInfo not found.');
        }
        // delete userBasicInfo
        if ($this->userBasicInfoService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserBasicInfo deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserBasicInfo cannot be deleted.');
        }
    }
}
