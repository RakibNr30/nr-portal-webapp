<?php

namespace Modules\Cms\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Cms\Services\MenuService;

// requests...
use Modules\Cms\Http\Requests\MenuStoreRequest;
use Modules\Cms\Http\Requests\MenuUpdateRequest;

// resources...
use Modules\Cms\Transformers\MenuResource;

class MenuController extends Controller
{
    /**
     * @var $menuService
     */
    protected $menuService;

    /**
     * Constructor
     *
     * @param MenuService $menuService
     */
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    /**
     * Menu list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all menus
        $menus = $this->menuService->all(request()->get('limit') ?? 0);
        // if no menu found
        if (!count($menus)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('Menu not available.');
        }
        // transform menus
        $menus = MenuResource::collection($menus);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($menus);
    }

    /**
     * Store a menu.
     *
     * @param MenuStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuStoreRequest $request)
    {
        // create menu
        $menu = $this->menuService->create($request->all());
        // check if created
        if ($menu) {
            // transform menu
            $menu = MenuResource::make($menu);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('Menu created successfully.')
                ->data($menu);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Menu cannot be created.');
        }
    }

    /**
     * Show menu.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get menu
        $menu = $this->menuService->find($id);
        // if no menu found
        if (empty($menu)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Menu not found.');
        }
        // transform menu
        $menu = MenuResource::make($menu);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Menu is available.')
            ->data($menu);
    }

    /**
     * Update menu.
     *
     * @param MenuUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuUpdateRequest $request, $id)
    {
        // get menu
        $menu = $this->menuService->find($id);
        // if no menu found
        if (empty($menu)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Menu not found.');
        }
        // update menu
        $menu = $this->menuService->update($request->all(), $id);
        // check if updated
        if ($menu) {
            // get updated menu
            $menu = $this->menuService->find($id);
            // transform menu
            $menu = MenuResource::make($menu);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Menu updated successfully.')
                ->data($menu);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Menu cannot be updated.');
        }
    }

    /**
     * Remove menu.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get menu
        $menu = $this->menuService->find($id);
        // if no menu found
        if (empty($menu)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Menu not found.');
        }
        // delete menu
        if ($this->menuService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Menu deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Menu cannot be deleted.');
        }
    }
}
