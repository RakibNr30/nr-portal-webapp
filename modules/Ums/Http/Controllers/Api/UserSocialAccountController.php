<?php

namespace Modules\Ums\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Ums\Services\UserSocialAccountService;

// requests...
use Modules\Ums\Http\Requests\UserSocialAccountStoreRequest;
use Modules\Ums\Http\Requests\UserSocialAccountUpdateRequest;

// resources...
use Modules\Ums\Transformers\UserSocialAccountResource;

class UserSocialAccountController extends Controller
{
    /**
     * @var $userSocialAccountService
     */
    protected $userSocialAccountService;

    /**
     * Constructor
     *
     * @param UserSocialAccountService $userSocialAccountService
     */
    public function __construct(UserSocialAccountService $userSocialAccountService)
    {
        $this->userSocialAccountService = $userSocialAccountService;
    }

    /**
     * UserSocialAccount list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all userSocialAccounts
        $userSocialAccounts = $this->userSocialAccountService->all(request()->get('limit') ?? 0);
        // if no userSocialAccount found
        if (!count($userSocialAccounts)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('UserSocialAccount not available.');
        }
        // transform userSocialAccounts
        $userSocialAccounts = UserSocialAccountResource::collection($userSocialAccounts);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($userSocialAccounts);
    }

    /**
     * Store a userSocialAccount.
     *
     * @param UserSocialAccountStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserSocialAccountStoreRequest $request)
    {
        // create userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->create($request->all());
        // check if created
        if ($userSocialAccount) {
            // transform userSocialAccount
            $userSocialAccount = UserSocialAccountResource::make($userSocialAccount);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('UserSocialAccount created successfully.')
                ->data($userSocialAccount);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserSocialAccount cannot be created.');
        }
    }

    /**
     * Show userSocialAccount.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->find($id);
        // if no userSocialAccount found
        if (empty($userSocialAccount)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserSocialAccount not found.');
        }
        // transform userSocialAccount
        $userSocialAccount = UserSocialAccountResource::make($userSocialAccount);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('UserSocialAccount is available.')
            ->data($userSocialAccount);
    }

    /**
     * Update userSocialAccount.
     *
     * @param UserSocialAccountUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserSocialAccountUpdateRequest $request, $id)
    {
        // get userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->find($id);
        // if no userSocialAccount found
        if (empty($userSocialAccount)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserSocialAccount not found.');
        }
        // update userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->update($request->all(), $id);
        // check if updated
        if ($userSocialAccount) {
            // get updated userSocialAccount
            $userSocialAccount = $this->userSocialAccountService->find($id);
            // transform userSocialAccount
            $userSocialAccount = UserSocialAccountResource::make($userSocialAccount);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserSocialAccount updated successfully.')
                ->data($userSocialAccount);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserSocialAccount cannot be updated.');
        }
    }

    /**
     * Remove userSocialAccount.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->find($id);
        // if no userSocialAccount found
        if (empty($userSocialAccount)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('UserSocialAccount not found.');
        }
        // delete userSocialAccount
        if ($this->userSocialAccountService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('UserSocialAccount deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('UserSocialAccount cannot be deleted.');
        }
    }
}
