<?php

namespace Modules\Cms\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Cms\Services\ArticleService;

// requests...
use Modules\Cms\Http\Requests\ArticleStoreRequest;
use Modules\Cms\Http\Requests\ArticleUpdateRequest;

// resources...
use Modules\Cms\Transformers\ArticleResource;

class ArticleController extends Controller
{
    /**
     * @var $articleService
     */
    protected $articleService;

    /**
     * Constructor
     *
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Article list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all articles
        $articles = $this->articleService->all(request()->get('limit') ?? 0);
        // if no article found
        if (!count($articles)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('Article not available.');
        }
        // transform articles
        $articles = ArticleResource::collection($articles);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($articles);
    }

    /**
     * Store a article.
     *
     * @param ArticleStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleStoreRequest $request)
    {
        // create article
        $article = $this->articleService->create($request->all());
        // check if created
        if ($article) {
            // transform article
            $article = ArticleResource::make($article);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('Article created successfully.')
                ->data($article);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Article cannot be created.');
        }
    }

    /**
     * Show article.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get article
        $article = $this->articleService->find($id);
        // if no article found
        if (empty($article)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Article not found.');
        }
        // transform article
        $article = ArticleResource::make($article);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Article is available.')
            ->data($article);
    }

    /**
     * Update article.
     *
     * @param ArticleUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleUpdateRequest $request, $id)
    {
        // get article
        $article = $this->articleService->find($id);
        // if no article found
        if (empty($article)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Article not found.');
        }
        // update article
        $article = $this->articleService->update($request->all(), $id);
        // check if updated
        if ($article) {
            // get updated article
            $article = $this->articleService->find($id);
            // transform article
            $article = ArticleResource::make($article);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Article updated successfully.')
                ->data($article);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Article cannot be updated.');
        }
    }

    /**
     * Remove article.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get article
        $article = $this->articleService->find($id);
        // if no article found
        if (empty($article)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Article not found.');
        }
        // delete article
        if ($this->articleService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Article deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Article cannot be deleted.');
        }
    }
}
