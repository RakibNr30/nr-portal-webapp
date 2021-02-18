<?php

namespace Modules\Cms\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Cms\Services\ArticleViewService;

// requests...
use Modules\Cms\Http\Requests\ArticleViewStoreRequest;
use Modules\Cms\Http\Requests\ArticleViewUpdateRequest;

// resources...
use Modules\Cms\Transformers\ArticleViewResource;

class ArticleViewController extends Controller
{
    /**
     * @var $articleViewService
     */
    protected $articleViewService;

    /**
     * Constructor
     *
     * @param ArticleViewService $articleViewService
     */
    public function __construct(ArticleViewService $articleViewService)
    {
        $this->articleViewService = $articleViewService;
    }

    /**
     * ArticleView list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all articleViews
        $articleViews = $this->articleViewService->all(request()->get('limit') ?? 0);
        // if no articleView found
        if (!count($articleViews)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('ArticleView not available.');
        }
        // transform articleViews
        $articleViews = ArticleViewResource::collection($articleViews);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($articleViews);
    }

    /**
     * Store a articleView.
     *
     * @param ArticleViewStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleViewStoreRequest $request)
    {
        // create articleView
        $articleView = $this->articleViewService->create($request->all());
        // check if created
        if ($articleView) {
            // transform articleView
            $articleView = ArticleViewResource::make($articleView);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('ArticleView created successfully.')
                ->data($articleView);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('ArticleView cannot be created.');
        }
    }

    /**
     * Show articleView.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get articleView
        $articleView = $this->articleViewService->find($id);
        // if no articleView found
        if (empty($articleView)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('ArticleView not found.');
        }
        // transform articleView
        $articleView = ArticleViewResource::make($articleView);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('ArticleView is available.')
            ->data($articleView);
    }

    /**
     * Update articleView.
     *
     * @param ArticleViewUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleViewUpdateRequest $request, $id)
    {
        // get articleView
        $articleView = $this->articleViewService->find($id);
        // if no articleView found
        if (empty($articleView)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('ArticleView not found.');
        }
        // update articleView
        $articleView = $this->articleViewService->update($request->all(), $id);
        // check if updated
        if ($articleView) {
            // get updated articleView
            $articleView = $this->articleViewService->find($id);
            // transform articleView
            $articleView = ArticleViewResource::make($articleView);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('ArticleView updated successfully.')
                ->data($articleView);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('ArticleView cannot be updated.');
        }
    }

    /**
     * Remove articleView.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get articleView
        $articleView = $this->articleViewService->find($id);
        // if no articleView found
        if (empty($articleView)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('ArticleView not found.');
        }
        // delete articleView
        if ($this->articleViewService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('ArticleView deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('ArticleView cannot be deleted.');
        }
    }
}
