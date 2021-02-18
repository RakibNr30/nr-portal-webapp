<?php

namespace Modules\Ums\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Ums\Services\UserWorkInfoService;

// requests...
use Modules\Ums\Http\Requests\UserWorkInfoStoreRequest;
use Modules\Ums\Http\Requests\UserWorkInfoUpdateRequest;

// resources...
use Modules\Ums\Transformers\UserWorkInfoResource;

class UserWorkInfoController extends Controller
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
     * UserWorkInfo list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all userWorkInfos
        $userWorkInfos = $this->userWorkInfoService->all(request()->get('limit') ?? 0);
        // if no userWorkInfo found
        if (!count($userWorkInfos)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('UserWorkInfo not available.');
        }
        // transform userWorkInfos
        $userWorkInfos = UserWorkInfoResource::collection($userWorkInfos);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($userWorkInfos);
    }

    /**
     * Store a userWorkInfo.
     *
     * @param UserWorkInfoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserWorkInfoStoreRequest $request)
    {
        // create userWorkInfo
        $userWorkInfo = $this->userWorkInfoService->create($request->all());
        // check if created
        if ($userWorkInfo) {
            // transform userWorkInfo
            $userWorkInfo = UserWorkInfoResource::make($userWorkInfo);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('UserWorkInfo created successfully.')
                ->data($userWorkInfo);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserWorkInfo cannot be created.');
        }
    }

    /**
     * Show userWorkInfo.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get userWorkInfo
        $userWorkInfo = $this->userWorkInfoService->find($id);
        // if no userWorkInfo found
        if (empty($userWorkInfo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserWorkInfo not found.');
        }
        // transform userWorkInfo
        $userWorkInfo = UserWorkInfoResource::make($userWorkInfo);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('UserWorkInfo is available.')
            ->data($userWorkInfo);
    }

    /**
     * Update userWorkInfo.
     *
     * @param UserWorkInfoUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserWorkInfoUpdateRequest $request, $id)
    {
        // get userWorkInfo
        $userWorkInfo = $this->userWorkInfoService->find($id);
        // if no userWorkInfo found
        if (empty($userWorkInfo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserWorkInfo not found.');
        }
        // update userWorkInfo
        $userWorkInfo = $this->userWorkInfoService->update($request->all(), $id);
        // check if updated
        if ($userWorkInfo) {
            // get updated userWorkInfo
            $userWorkInfo = $this->userWorkInfoService->find($id);
            // transform userWorkInfo
            $userWorkInfo = UserWorkInfoResource::make($userWorkInfo);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserWorkInfo updated successfully.')
                ->data($userWorkInfo);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserWorkInfo cannot be updated.');
        }
    }

    /**
     * Remove userWorkInfo.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get userWorkInfo
        $userWorkInfo = $this->userWorkInfoService->find($id);
        // if no userWorkInfo found
        if (empty($userWorkInfo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserWorkInfo not found.');
        }
        // delete userWorkInfo
        if ($this->userWorkInfoService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserWorkInfo deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserWorkInfo cannot be deleted.');
        }
    }
}
