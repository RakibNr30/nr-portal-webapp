<?php

namespace Modules\Ums\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Ums\Services\UserService;

// requests...
use Modules\Ums\Http\Requests\UserStoreRequest;
use Modules\Ums\Http\Requests\UserUpdateRequest;

// resources...
use Modules\Ums\Transformers\UserResource;

class UserController extends Controller
{
    /**
     * @var $userService
     */
    protected $userService;

    /**
     * Constructor
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * User list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all users
        $users = $this->userService->all(request()->get('limit') ?? 0);
        // if no user found
        if (!count($users)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('User not available.');
        }
        // transform users
        $users = UserResource::collection($users);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($users);
    }

    /**
     * Store a user.
     *
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        // create user
        $user = $this->userService->create($request->all());
        // check if created
        if ($user) {
            // transform user
            $user = UserResource::make($user);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('User created successfully.')
                ->data($user);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('User cannot be created.');
        }
    }

    /**
     * Show user.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get user
        $user = $this->userService->find($id);
        // if no user found
        if (empty($user)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('User not found.');
        }
        // transform user
        $user = UserResource::make($user);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('User is available.')
            ->data($user);
    }

    /**
     * Update user.
     *
     * @param UserUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        // get user
        $user = $this->userService->find($id);
        // if no user found
        if (empty($user)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('User not found.');
        }
        // update user
        $user = $this->userService->update($request->all(), $id);
        // check if updated
        if ($user) {
            // get updated user
            $user = $this->userService->find($id);
            // transform user
            $user = UserResource::make($user);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('User updated successfully.')
                ->data($user);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('User cannot be updated.');
        }
    }

    /**
     * Remove user.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get user
        $user = $this->userService->find($id);
        // if no user found
        if (empty($user)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('User not found.');
        }
        // delete user
        if ($this->userService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('User deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('User cannot be deleted.');
        }
    }
}
