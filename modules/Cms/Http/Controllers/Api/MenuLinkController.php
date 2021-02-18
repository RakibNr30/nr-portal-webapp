<?php

namespace Modules\Cms\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Cms\Services\MenuLinkService;

// requests...
use Modules\Cms\Http\Requests\MenuLinkStoreRequest;
use Modules\Cms\Http\Requests\MenuLinkUpdateRequest;

// resources...
use Modules\Cms\Transformers\MenuLinkResource;

class MenuLinkController extends Controller
{
    /**
     * @var $menuLinkService
     */
    protected $menuLinkService;

    /**
     * Constructor
     *
     * @param MenuLinkService $menuLinkService
     */
    public function __construct(MenuLinkService $menuLinkService)
    {
        $this->menuLinkService = $menuLinkService;
    }

    /**
     * MenuLink list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all menuLinks
        $menuLinks = $this->menuLinkService->all(request()->get('limit') ?? 0);
        // if no menuLink found
        if (!count($menuLinks)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('MenuLink not available.');
        }
        // transform menuLinks
        $menuLinks = MenuLinkResource::collection($menuLinks);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($menuLinks);
    }

    /**
     * Store a menuLink.
     *
     * @param MenuLinkStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuLinkStoreRequest $request)
    {
        // create menuLink
        $menuLink = $this->menuLinkService->create($request->all());
        // check if created
        if ($menuLink) {
            // transform menuLink
            $menuLink = MenuLinkResource::make($menuLink);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('MenuLink created successfully.')
                ->data($menuLink);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('MenuLink cannot be created.');
        }
    }

    /**
     * Show menuLink.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get menuLink
        $menuLink = $this->menuLinkService->find($id);
        // if no menuLink found
        if (empty($menuLink)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('MenuLink not found.');
        }
        // transform menuLink
        $menuLink = MenuLinkResource::make($menuLink);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('MenuLink is available.')
            ->data($menuLink);
    }

    /**
     * Update menuLink.
     *
     * @param MenuLinkUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuLinkUpdateRequest $request, $id)
    {
        // get menuLink
        $menuLink = $this->menuLinkService->find($id);
        // if no menuLink found
        if (empty($menuLink)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('MenuLink not found.');
        }
        // update menuLink
        $menuLink = $this->menuLinkService->update($request->all(), $id);
        // check if updated
        if ($menuLink) {
            // get updated menuLink
            $menuLink = $this->menuLinkService->find($id);
            // transform menuLink
            $menuLink = MenuLinkResource::make($menuLink);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('MenuLink updated successfully.')
                ->data($menuLink);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('MenuLink cannot be updated.');
        }
    }

    /**
     * Remove menuLink.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get menuLink
        $menuLink = $this->menuLinkService->find($id);
        // if no menuLink found
        if (empty($menuLink)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('MenuLink not found.');
        }
        // delete menuLink
        if ($this->menuLinkService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('MenuLink deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('MenuLink cannot be deleted.');
        }
    }
}
