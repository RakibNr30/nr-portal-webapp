<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\Http\Requests\ArticleStoreRequest;
use Modules\Cms\Http\Requests\ArticleUpdateRequest;

// datatable...
use Modules\Cms\Datatables\ArticleDatatable;

// services...
use Modules\Cms\Services\ArticleCategoryService;
use Modules\Cms\Services\ArticleService;

class ArticleController extends Controller
{
    /**
     * @var $articleService
     */
    protected $articleService;

    /**
     * @var $articleCategoryService
     */
    protected $articleCategoryService;

    /**
     * Constructor
     *
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService, ArticleCategoryService $articleCategoryService)
    {
        $this->articleService = $articleService;
        $this->articleCategoryService = $articleCategoryService;
    }

    /**
     * Article list
     *
     * @param ArticleDatatable $datatable
     * @return \Illuminate\View\View
     */
    public function index(ArticleDatatable $datatable)
    {
        return $datatable->render('cms::article.index');
    }

    /**
     * Create article
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // get article categories
        $articleCategories = $this->articleCategoryService->all();
        // return view
        return view('cms::article.create', compact('articleCategories'));
    }


    /**
     * Store article
     *
     * @param ArticleStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ArticleStoreRequest $request)
    {
        // get request data
        $data = $request->all();
        $data['author_id'] = auth()->user()->id;
        // create article
        $article = $this->articleService->create($data);
        // upload files
        $article->uploadFiles();
        // check if article created
        if ($article) {
            // flash notification
            notifier()->success('Article created successfully.');
        } else {
            // flash notification
            notifier()->error('Article cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show article.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get article
        $article = $this->articleService->find($id);
        // check if article doesn't exists
        if (empty($article)) {
            // flash notification
            notifier()->error('Article not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::article.show', compact('article'));
    }

    /**
     * Show article.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get article categories
        $articleCategories = $this->articleCategoryService->all();
        // get article
        $article = $this->articleService->find($id);
        // check if article doesn't exists
        if (empty($article)) {
            // flash notification
            notifier()->error('Article not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::article.edit', compact('article', 'articleCategories'));
    }

    /**
     * Update article
     *
     * @param ArticleUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ArticleUpdateRequest $request, $id)
    {
        // get article
        $article = $this->articleService->find($id);
        // upload files
        $article->uploadFiles();
        // check if article doesn't exists
        if (empty($article)) {
            // flash notification
            notifier()->error('Article not found!');
            // redirect back
            return redirect()->back();
        }
        // update article
        $article = $this->articleService->update($request->all(), $id);
        // check if article updated
        if ($article) {
            // flash notification
            notifier()->success('Article updated successfully.');
        } else {
            // flash notification
            notifier()->error('Article cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete article
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get article
        $article = $this->articleService->find($id);
        // check if article doesn't exists
        if (empty($article)) {
            // flash notification
            notifier()->error('Article not found!');
            // redirect back
            return redirect()->back();
        }
        // delete article
        if ($this->articleService->delete($id)) {
            // flash notification
            notifier()->success('Article deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Article cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
