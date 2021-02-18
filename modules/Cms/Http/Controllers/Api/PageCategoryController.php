<?php

namespace Modules\Cms\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Cms\Services\PageCategoryService;

// requests...
use Modules\Cms\Http\Requests\PageCategoryStoreRequest;
use Modules\Cms\Http\Requests\PageCategoryUpdateRequest;

// resources...
use Modules\Cms\Transformers\PageCategoryResource;

class PageCategoryController extends Controller
{
    /**
     * @var $pageCategoryService
     */
    protected $pageCategoryService;

    /**
     * Constructor
     *
     * @param PageCategoryService $pageCategoryService
     */
    public function __construct(PageCategoryService $pageCategoryService)
    {
        $this->pageCategoryService = $pageCategoryService;
    }

    /**
     * PageCategory list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all pageCategories
        $pageCategories = $this->pageCategoryService->all(request()->get('limit') ?? 0);
        // if no pageCategory found
        if (!count($pageCategories)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('PageCategory not available.');
        }
        // transform pageCategories
        $pageCategories = PageCategoryResource::collection($pageCategories);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($pageCategories);
    }

    /**
     * Store a pageCategory.
     *
     * @param PageCategoryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageCategoryStoreRequest $request)
    {
        // create pageCategory
        $pageCategory = $this->pageCategoryService->create($request->all());
        // check if created
        if ($pageCategory) {
            // transform pageCategory
            $pageCategory = PageCategoryResource::make($pageCategory);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('PageCategory created successfully.')
                ->data($pageCategory);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('PageCategory cannot be created.');
        }
    }

    /**
     * Show pageCategory.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get pageCategory
        $pageCategory = $this->pageCategoryService->find($id);
        // if no pageCategory found
        if (empty($pageCategory)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('PageCategory not found.');
        }
        // transform pageCategory
        $pageCategory = PageCategoryResource::make($pageCategory);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('PageCategory is available.')
            ->data($pageCategory);
    }

    /**
     * Update pageCategory.
     *
     * @param PageCategoryUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageCategoryUpdateRequest $request, $id)
    {
        // get pageCategory
        $pageCategory = $this->pageCategoryService->find($id);
        // if no pageCategory found
        if (empty($pageCategory)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('PageCategory not found.');
        }
        // update pageCategory
        $pageCategory = $this->pageCategoryService->update($request->all(), $id);
        // check if updated
        if ($pageCategory) {
            // get updated pageCategory
            $pageCategory = $this->pageCategoryService->find($id);
            // transform pageCategory
            $pageCategory = PageCategoryResource::make($pageCategory);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('PageCategory updated successfully.')
                ->data($pageCategory);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('PageCategory cannot be updated.');
        }
    }

    /**
     * Remove pageCategory.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get pageCategory
        $pageCategory = $this->pageCategoryService->find($id);
        // if no pageCategory found
        if (empty($pageCategory)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('PageCategory not found.');
        }
        // delete pageCategory
        if ($this->pageCategoryService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('PageCategory deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('PageCategory cannot be deleted.');
        }
    }
}
