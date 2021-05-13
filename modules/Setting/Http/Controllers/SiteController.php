<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Setting\Http\Requests\SiteUpdateRequest;

// services...
use Modules\Setting\Services\SiteService;

class SiteController extends Controller
{
    /**
     * @var $siteService
     */
    protected $siteService;

    /**
     * Constructor
     *
     * @param SiteService $siteService
     */
    public function __construct(SiteService $siteService)
    {
        $this->siteService = $siteService;
        $this->middleware(['permission:site_settings']);
    }

    /**
     * Site list
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // get site data
        $site = $this->siteService->firstOrCreate([]);
        // return view
        return view('setting::site.index', compact('site'));
    }

    /**
     * Update site
     *
     * @param SiteUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SiteUpdateRequest $request, $id)
    {
        // get site
        $site = $this->siteService->find($id);
        // upload files
        $site->uploadFiles();
        // check if site doesn't exists
        if (empty($site)) {
            // flash notification
            notifier()->error(__('admin/notifier.site_not_found'));
            // redirect back
            return redirect()->back();
        }
        // update site
        $site = $this->siteService->update($request->all(), $id);
        // check if site updated
        if ($site) {
            // flash notification
            notifier()->success(__('admin/notifier.site_updated_successfully'));
        } else {
            // flash notification
            notifier()->error(__('admin/notifier.site_cannot_be_updated_successfully'));
        }
        // redirect back
        return redirect()->back();
    }
}
