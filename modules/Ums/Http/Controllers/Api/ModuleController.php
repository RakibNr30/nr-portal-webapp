<?php

namespace Modules\Ums\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Ums\Services\ModuleService;

// requests...
use Modules\Ums\Http\Requests\ModuleStoreRequest;
use Modules\Ums\Http\Requests\ModuleUpdateRequest;

// resources...
use Modules\Ums\Transformers\ModuleResource;

class ModuleController extends Controller
{
    /**
     * @var $moduleService
     */
    protected $moduleService;

    /**
     * Constructor
     *
     * @param ModuleService $moduleService
     */
    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    /**
     * Module list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all modules
        $modules = $this->moduleService->all(request()->get('limit') ?? 0);
        // if no module found
        if (!count($modules)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('Module not available.');
        }
        // transform modules
        $modules = ModuleResource::collection($modules);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($modules);
    }

    /**
     * Store a module.
     *
     * @param ModuleStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuleStoreRequest $request)
    {
        // create module
        $module = $this->moduleService->create($request->all());
        // check if created
        if ($module) {
            // transform module
            $module = ModuleResource::make($module);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('Module created successfully.')
                ->data($module);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Module cannot be created.');
        }
    }

    /**
     * Show module.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get module
        $module = $this->moduleService->find($id);
        // if no module found
        if (empty($module)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Module not found.');
        }
        // transform module
        $module = ModuleResource::make($module);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Module is available.')
            ->data($module);
    }

    /**
     * Update module.
     *
     * @param ModuleUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModuleUpdateRequest $request, $id)
    {
        // get module
        $module = $this->moduleService->find($id);
        // if no module found
        if (empty($module)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Module not found.');
        }
        // update module
        $module = $this->moduleService->update($request->all(), $id);
        // check if updated
        if ($module) {
            // get updated module
            $module = $this->moduleService->find($id);
            // transform module
            $module = ModuleResource::make($module);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Module updated successfully.')
                ->data($module);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Module cannot be updated.');
        }
    }

    /**
     * Remove module.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get module
        $module = $this->moduleService->find($id);
        // if no module found
        if (empty($module)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Module not found.');
        }
        // delete module
        if ($this->moduleService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Module deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Module cannot be deleted.');
        }
    }
}
