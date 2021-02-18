<?php

namespace Modules\Cms\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Cms\Services\PageService;

// requests...
use Modules\Cms\Http\Requests\PageStoreRequest;
use Modules\Cms\Http\Requests\PageUpdateRequest;

// resources...
use Modules\Cms\Transformers\PageResource;

class PageController extends Controller
{
    /**
     * @var $pageService
     */
    protected $pageService;

    /**
     * Constructor
     *
     * @param PageService $pageService
     */
    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    /**
     * Page list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all pages
        $pages = $this->pageService->all(request()->get('limit') ?? 0);
        // if no page found
        if (!count($pages)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('Page not available.');
        }
        // transform pages
        $pages = PageResource::collection($pages);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($pages);
    }

    /**
     * Store a page.
     *
     * @param PageStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageStoreRequest $request)
    {
        // create page
        $page = $this->pageService->create($request->all());
        // check if created
        if ($page) {
            // transform page
            $page = PageResource::make($page);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('Page created successfully.')
                ->data($page);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Page cannot be created.');
        }
    }

    /**
     * Show page.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get page
        $page = $this->pageService->find($id);
        // if no page found
        if (empty($page)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Page not found.');
        }
        // transform page
        $page = PageResource::make($page);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Page is available.')
            ->data($page);
    }

    /**
     * Update page.
     *
     * @param PageUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageUpdateRequest $request, $id)
    {
        // get page
        $page = $this->pageService->find($id);
        // if no page found
        if (empty($page)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Page not found.');
        }
        // update page
        $page = $this->pageService->update($request->all(), $id);
        // check if updated
        if ($page) {
            // get updated page
            $page = $this->pageService->find($id);
            // transform page
            $page = PageResource::make($page);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Page updated successfully.')
                ->data($page);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Page cannot be updated.');
        }
    }

    /**
     * Remove page.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get page
        $page = $this->pageService->find($id);
        // if no page found
        if (empty($page)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Page not found.');
        }
        // delete page
        if ($this->pageService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Page deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Page cannot be deleted.');
        }
    }
}
