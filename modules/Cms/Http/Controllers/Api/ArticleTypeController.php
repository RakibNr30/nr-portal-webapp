<?php

namespace Modules\Cms\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Cms\Services\ArticleCategoryService;

// requests...
use Modules\Cms\Http\Requests\ArticleCategoryStoreRequest;
use Modules\Cms\Http\Requests\ArticleCategoryUpdateRequest;

// resources...
use Modules\Cms\Transformers\ArticleCategoryResource;

class ArticleTypeController extends Controller
{
    /**
     * @var $articleTypeService
     */
    protected $articleTypeService;

    /**
     * Constructor
     *
     * @param ArticleCategoryService $articleTypeService
     */
    public function __construct(ArticleCategoryService $articleTypeService)
    {
        $this->articleTypeService = $articleTypeService;
    }

    /**
     * ArticleCategory list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all articleTypes
        $articleTypes = $this->articleTypeService->all(request()->get('limit') ?? 0);
        // if no articleType found
        if (!count($articleTypes)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('ArticleCategory not available.');
        }
        // transform articleTypes
        $articleTypes = ArticleCategoryResource::collection($articleTypes);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($articleTypes);
    }

    /**
     * Store a articleType.
     *
     * @param ArticleCategoryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleCategoryStoreRequest $request)
    {
        // create articleType
        $articleType = $this->articleTypeService->create($request->all());
        // check if created
        if ($articleType) {
            // transform articleType
            $articleType = ArticleCategoryResource::make($articleType);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('ArticleCategory created successfully.')
                ->data($articleType);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('ArticleCategory cannot be created.');
        }
    }

    /**
     * Show articleType.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get articleType
        $articleType = $this->articleTypeService->find($id);
        // if no articleType found
        if (empty($articleType)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('ArticleCategory not found.');
        }
        // transform articleType
        $articleType = ArticleCategoryResource::make($articleType);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('ArticleCategory is available.')
            ->data($articleType);
    }

    /**
     * Update articleType.
     *
     * @param ArticleCategoryUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleCategoryUpdateRequest $request, $id)
    {
        // get articleType
        $articleType = $this->articleTypeService->find($id);
        // if no articleType found
        if (empty($articleType)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('ArticleCategory not found.');
        }
        // update articleType
        $articleType = $this->articleTypeService->update($request->all(), $id);
        // check if updated
        if ($articleType) {
            // get updated articleType
            $articleType = $this->articleTypeService->find($id);
            // transform articleType
            $articleType = ArticleCategoryResource::make($articleType);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('ArticleCategory updated successfully.')
                ->data($articleType);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('ArticleCategory cannot be updated.');
        }
    }

    /**
     * Remove articleType.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get articleType
        $articleType = $this->articleTypeService->find($id);
        // if no articleType found
        if (empty($articleType)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('ArticleCategory not found.');
        }
        // delete articleType
        if ($this->articleTypeService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('ArticleCategory deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('ArticleCategory cannot be deleted.');
        }
    }
}
