<?php

namespace Modules\Ums\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Ums\Services\UserEducationalInfoService;

// requests...
use Modules\Ums\Http\Requests\UserEducationalInfoStoreRequest;
use Modules\Ums\Http\Requests\UserEducationalInfoUpdateRequest;

// resources...
use Modules\Ums\Transformers\UserEducationalInfoResource;

class UserEducationalInfoController extends Controller
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
     * UserEducationalInfo list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all userEducationalInfos
        $userEducationalInfos = $this->userEducationalInfoService->all(request()->get('limit') ?? 0);
        // if no userEducationalInfo found
        if (!count($userEducationalInfos)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('UserEducationalInfo not available.');
        }
        // transform userEducationalInfos
        $userEducationalInfos = UserEducationalInfoResource::collection($userEducationalInfos);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($userEducationalInfos);
    }

    /**
     * Store a userEducationalInfo.
     *
     * @param UserEducationalInfoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserEducationalInfoStoreRequest $request)
    {
        // create userEducationalInfo
        $userEducationalInfo = $this->userEducationalInfoService->create($request->all());
        // check if created
        if ($userEducationalInfo) {
            // transform userEducationalInfo
            $userEducationalInfo = UserEducationalInfoResource::make($userEducationalInfo);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('UserEducationalInfo created successfully.')
                ->data($userEducationalInfo);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserEducationalInfo cannot be created.');
        }
    }

    /**
     * Show userEducationalInfo.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get userEducationalInfo
        $userEducationalInfo = $this->userEducationalInfoService->find($id);
        // if no userEducationalInfo found
        if (empty($userEducationalInfo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserEducationalInfo not found.');
        }
        // transform userEducationalInfo
        $userEducationalInfo = UserEducationalInfoResource::make($userEducationalInfo);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('UserEducationalInfo is available.')
            ->data($userEducationalInfo);
    }

    /**
     * Update userEducationalInfo.
     *
     * @param UserEducationalInfoUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEducationalInfoUpdateRequest $request, $id)
    {
        // get userEducationalInfo
        $userEducationalInfo = $this->userEducationalInfoService->find($id);
        // if no userEducationalInfo found
        if (empty($userEducationalInfo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserEducationalInfo not found.');
        }
        // update userEducationalInfo
        $userEducationalInfo = $this->userEducationalInfoService->update($request->all(), $id);
        // check if updated
        if ($userEducationalInfo) {
            // get updated userEducationalInfo
            $userEducationalInfo = $this->userEducationalInfoService->find($id);
            // transform userEducationalInfo
            $userEducationalInfo = UserEducationalInfoResource::make($userEducationalInfo);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserEducationalInfo updated successfully.')
                ->data($userEducationalInfo);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserEducationalInfo cannot be updated.');
        }
    }

    /**
     * Remove userEducationalInfo.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get userEducationalInfo
        $userEducationalInfo = $this->userEducationalInfoService->find($id);
        // if no userEducationalInfo found
        if (empty($userEducationalInfo)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserEducationalInfo not found.');
        }
        // delete userEducationalInfo
        if ($this->userEducationalInfoService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserEducationalInfo deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserEducationalInfo cannot be deleted.');
        }
    }
}
