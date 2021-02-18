<?php

namespace Modules\Ums\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Ums\Services\PermissionService;

// requests...
use Modules\Ums\Http\Requests\PermissionStoreRequest;
use Modules\Ums\Http\Requests\PermissionUpdateRequest;

// resources...
use Modules\Ums\Transformers\PermissionResource;

class PermissionController extends Controller
{
    /**
     * @var $permissionService
     */
    protected $permissionService;

    /**
     * Constructor
     *
     * @param PermissionService $permissionService
     */
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * Permission list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all permissions
        $permissions = $this->permissionService->all(request()->get('limit') ?? 0);
        // if no permission found
        if (!count($permissions)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('Permission not available.');
        }
        // transform permissions
        $permissions = PermissionResource::collection($permissions);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($permissions);
    }

    /**
     * Store a permission.
     *
     * @param PermissionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionStoreRequest $request)
    {
        // create permission
        $permission = $this->permissionService->create($request->all());
        // check if created
        if ($permission) {
            // transform permission
            $permission = PermissionResource::make($permission);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('Permission created successfully.')
                ->data($permission);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Permission cannot be created.');
        }
    }

    /**
     * Show permission.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get permission
        $permission = $this->permissionService->find($id);
        // if no permission found
        if (empty($permission)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Permission not found.');
        }
        // transform permission
        $permission = PermissionResource::make($permission);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Permission is available.')
            ->data($permission);
    }

    /**
     * Update permission.
     *
     * @param PermissionUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionUpdateRequest $request, $id)
    {
        // get permission
        $permission = $this->permissionService->find($id);
        // if no permission found
        if (empty($permission)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Permission not found.');
        }
        // update permission
        $permission = $this->permissionService->update($request->all(), $id);
        // check if updated
        if ($permission) {
            // get updated permission
            $permission = $this->permissionService->find($id);
            // transform permission
            $permission = PermissionResource::make($permission);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Permission updated successfully.')
                ->data($permission);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Permission cannot be updated.');
        }
    }

    /**
     * Remove permission.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get permission
        $permission = $this->permissionService->find($id);
        // if no permission found
        if (empty($permission)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Permission not found.');
        }
        // delete permission
        if ($this->permissionService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Permission deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Permission cannot be deleted.');
        }
    }
}
