<?php

namespace Modules\Ums\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Ums\Services\UserInterestService;

// requests...
use Modules\Ums\Http\Requests\UserInterestStoreRequest;
use Modules\Ums\Http\Requests\UserInterestUpdateRequest;

// resources...
use Modules\Ums\Transformers\UserInterestResource;

class UserInterestController extends Controller
{
    /**
     * @var $userInterestService
     */
    protected $userInterestService;

    /**
     * Constructor
     *
     * @param UserInterestService $userInterestService
     */
    public function __construct(UserInterestService $userInterestService)
    {
        $this->userInterestService = $userInterestService;
    }

    /**
     * UserInterest list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all userInterests
        $userInterests = $this->userInterestService->all(request()->get('limit') ?? 0);
        // if no userInterest found
        if (!count($userInterests)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('UserInterest not available.');
        }
        // transform userInterests
        $userInterests = UserInterestResource::collection($userInterests);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($userInterests);
    }

    /**
     * Store a userInterest.
     *
     * @param UserInterestStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserInterestStoreRequest $request)
    {
        // create userInterest
        $userInterest = $this->userInterestService->create($request->all());
        // check if created
        if ($userInterest) {
            // transform userInterest
            $userInterest = UserInterestResource::make($userInterest);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('UserInterest created successfully.')
                ->data($userInterest);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserInterest cannot be created.');
        }
    }

    /**
     * Show userInterest.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get userInterest
        $userInterest = $this->userInterestService->find($id);
        // if no userInterest found
        if (empty($userInterest)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserInterest not found.');
        }
        // transform userInterest
        $userInterest = UserInterestResource::make($userInterest);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('UserInterest is available.')
            ->data($userInterest);
    }

    /**
     * Update userInterest.
     *
     * @param UserInterestUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserInterestUpdateRequest $request, $id)
    {
        // get userInterest
        $userInterest = $this->userInterestService->find($id);
        // if no userInterest found
        if (empty($userInterest)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserInterest not found.');
        }
        // update userInterest
        $userInterest = $this->userInterestService->update($request->all(), $id);
        // check if updated
        if ($userInterest) {
            // get updated userInterest
            $userInterest = $this->userInterestService->find($id);
            // transform userInterest
            $userInterest = UserInterestResource::make($userInterest);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserInterest updated successfully.')
                ->data($userInterest);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserInterest cannot be updated.');
        }
    }

    /**
     * Remove userInterest.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get userInterest
        $userInterest = $this->userInterestService->find($id);
        // if no userInterest found
        if (empty($userInterest)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserInterest not found.');
        }
        // delete userInterest
        if ($this->userInterestService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserInterest deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserInterest cannot be deleted.');
        }
    }
}
