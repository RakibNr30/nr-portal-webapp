<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\Http\Requests\ArticleViewStoreRequest;
use Modules\Cms\Http\Requests\ArticleViewUpdateRequest;

// datatable...
use Modules\Cms\Datatables\ArticleViewDatatable;

// services...
use Modules\Cms\Services\ArticleViewService;

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
     * ArticleView list
     *
     * @param ArticleViewDatatable $datatable
     * @return \Illuminate\View\View
     */
    public function index(ArticleViewDatatable $datatable)
    {
        return $datatable->render('cms::article_view.index');
    }

    /**
     * Create articleView
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('cms::article_view.create');
    }


    /**
     * Store articleView
     *
     * @param ArticleViewStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ArticleViewStoreRequest $request)
    {
        // create articleView
        $articleView = $this->articleViewService->create($request->all());
        // check if articleView created
        if ($articleView) {
            // flash notification
            notifier()->success('ArticleView created successfully.');
        } else {
            // flash notification
            notifier()->error('ArticleView cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show articleView.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get articleView
        $articleView = $this->articleViewService->find($id);
        // check if articleView doesn't exists
        if (empty($articleView)) {
            // flash notification
            notifier()->error('ArticleView not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::article_view.show', compact('articleView'));
    }

    /**
     * Show articleView.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get articleView
        $articleView = $this->articleViewService->find($id);
        // check if articleView doesn't exists
        if (empty($articleView)) {
            // flash notification
            notifier()->error('ArticleView not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::article_view.edit', compact('articleView'));
    }

    /**
     * Update articleView
     *
     * @param ArticleViewUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ArticleViewUpdateRequest $request, $id)
    {
        // get articleView
        $articleView = $this->articleViewService->find($id);
        // check if articleView doesn't exists
        if (empty($articleView)) {
            // flash notification
            notifier()->error('ArticleView not found!');
            // redirect back
            return redirect()->back();
        }
        // update articleView
        $articleView = $this->articleViewService->update($request->all(), $id);
        // check if articleView updated
        if ($articleView) {
            // flash notification
            notifier()->success('ArticleView updated successfully.');
        } else {
            // flash notification
            notifier()->error('ArticleView cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete articleView
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get articleView
        $articleView = $this->articleViewService->find($id);
        // check if articleView doesn't exists
        if (empty($articleView)) {
            // flash notification
            notifier()->error('ArticleView not found!');
            // redirect back
            return redirect()->back();
        }
        // delete articleView
        if ($this->articleViewService->delete($id)) {
            // flash notification
            notifier()->success('ArticleView deleted successfully.');
        } else {
            // flash notification
            notifier()->success('ArticleView cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
