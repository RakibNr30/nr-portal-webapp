<?php

namespace Modules\Ums\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Ums\Services\RoleService;

// requests...
use Modules\Ums\Http\Requests\RoleStoreRequest;
use Modules\Ums\Http\Requests\RoleUpdateRequest;

// resources...
use Modules\Ums\Transformers\RoleResource;

class RoleController extends Controller
{
    /**
     * @var $roleService
     */
    protected $roleService;

    /**
     * Constructor
     *
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Role list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all roles
        $roles = $this->roleService->all(request()->get('limit') ?? 0);
        // if no role found
        if (!count($roles)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('Role not available.');
        }
        // transform roles
        $roles = RoleResource::collection($roles);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($roles);
    }

    /**
     * Store a role.
     *
     * @param RoleStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        // create role
        $role = $this->roleService->create($request->all());
        // check if created
        if ($role) {
            // transform role
            $role = RoleResource::make($role);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('Role created successfully.')
                ->data($role);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Role cannot be created.');
        }
    }

    /**
     * Show role.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get role
        $role = $this->roleService->find($id);
        // if no role found
        if (empty($role)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Role not found.');
        }
        // transform role
        $role = RoleResource::make($role);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Role is available.')
            ->data($role);
    }

    /**
     * Update role.
     *
     * @param RoleUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        // get role
        $role = $this->roleService->find($id);
        // if no role found
        if (empty($role)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Role not found.');
        }
        // update role
        $role = $this->roleService->update($request->all(), $id);
        // check if updated
        if ($role) {
            // get updated role
            $role = $this->roleService->find($id);
            // transform role
            $role = RoleResource::make($role);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Role updated successfully.')
                ->data($role);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Role cannot be updated.');
        }
    }

    /**
     * Remove role.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get role
        $role = $this->roleService->find($id);
        // if no role found
        if (empty($role)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Role not found.');
        }
        // delete role
        if ($this->roleService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Role deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Role cannot be deleted.');
        }
    }
}
