<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\Http\Requests\ArticleCategoryStoreRequest;
use Modules\Cms\Http\Requests\ArticleCategoryUpdateRequest;

// datatable...
use Modules\Cms\Datatables\ArticleCategoryDataTable;

// services...
use Modules\Cms\Services\ArticleCategoryService;

class ArticleCategoryController extends Controller
{
    /**
     * @var $articleCategoryService
     */
    protected $articleCategoryService;

    /**
     * Constructor
     *
     * @param ArticleCategoryService $articleCategoryService
     */
    public function __construct(ArticleCategoryService $articleCategoryService)
    {
        $this->articleCategoryService = $articleCategoryService;
    }

    /**
     * ArticleCategory list
     *
     * @param ArticleCategoryDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(ArticleCategoryDataTable $datatable)
    {
        return $datatable->render('cms::article_category.index');
    }

    /**
     * Create articleCategory
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('cms::article_category.create');
    }


    /**
     * Store articleCategory
     *
     * @param ArticleCategoryStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ArticleCategoryStoreRequest $request)
    {
        // create articleCategory
        $articleCategory = $this->articleCategoryService->create($request->all());
        // check if articleCategory created
        if ($articleCategory) {
            // flash notification
            notifier()->success('ArticleCategory created successfully.');
        } else {
            // flash notification
            notifier()->error('ArticleCategory cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show articleCategory.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get articleCategory
        $articleCategory = $this->articleCategoryService->find($id);
        // check if articleCategory doesn't exists
        if (empty($articleCategory)) {
            // flash notification
            notifier()->error('ArticleCategory not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::article_category.show', compact('articleCategory'));
    }

    /**
     * Show articleCategory.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get articleCategory
        $articleCategory = $this->articleCategoryService->find($id);
        // check if articleCategory doesn't exists
        if (empty($articleCategory)) {
            // flash notification
            notifier()->error('ArticleCategory not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::article_category.edit', compact('articleCategory'));
    }

    /**
     * Update articleCategory
     *
     * @param ArticleCategoryUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ArticleCategoryUpdateRequest $request, $id)
    {
        // get articleCategory
        $articleCategory = $this->articleCategoryService->find($id);
        // check if articleCategory doesn't exists
        if (empty($articleCategory)) {
            // flash notification
            notifier()->error('ArticleCategory not found!');
            // redirect back
            return redirect()->back();
        }
        // update articleCategory
        $articleCategory = $this->articleCategoryService->update($request->all(), $id);
        // check if articleCategory updated
        if ($articleCategory) {
            // flash notification
            notifier()->success('ArticleCategory updated successfully.');
        } else {
            // flash notification
            notifier()->error('ArticleCategory cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete articleCategory
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get articleCategory
        $articleCategory = $this->articleCategoryService->find($id);
        // check if articleCategory doesn't exists
        if (empty($articleCategory)) {
            // flash notification
            notifier()->error('ArticleCategory not found!');
            // redirect back
            return redirect()->back();
        }
        // delete articleCategory
        if ($this->articleCategoryService->delete($id)) {
            // flash notification
            notifier()->success('ArticleCategory deleted successfully.');
        } else {
            // flash notification
            notifier()->success('ArticleCategory cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
