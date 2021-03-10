<?php

namespace Modules\Ums\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\SocialSiteStoreRequest;
use Modules\Ums\Http\Requests\SocialSiteUpdateRequest;

// datatable...
use Modules\Ums\Datatables\SocialSiteDatatable;

// services...
use Modules\Ums\Services\SocialSiteService;

class SocialSiteController extends Controller
{
    /**
     * @var $socialSiteService
     */
    protected $socialSiteService;

    /**
     * Constructor
     *
     * @param SocialSiteService $socialSiteService
     */
    public function __construct(SocialSiteService $socialSiteService)
    {
        $this->socialSiteService = $socialSiteService;
        $this->middleware(['permission:core_settings']);
    }

    /**
     * SocialSite list
     *
     * @param SocialSiteDatatable $datatable
     * @return \Illuminate\View\View
     */
    public function index(SocialSiteDatatable $datatable)
    {
        return $datatable->render('ums::social_site.index');
    }

    /**
     * Create socialSite
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('ums::social_site.create');
    }


    /**
     * Store socialSite
     *
     * @param SocialSiteStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SocialSiteStoreRequest $request)
    {
        // create socialSite
        $socialSite = $this->socialSiteService->create($request->all());
        // check if socialSite created
        if ($socialSite) {
            // flash notification
            notifier()->success('SocialSite created successfully.');
        } else {
            // flash notification
            notifier()->error('SocialSite cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show socialSite.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get socialSite
        $socialSite = $this->socialSiteService->find($id);
        // check if socialSite doesn't exists
        if (empty($socialSite)) {
            // flash notification
            notifier()->error('SocialSite not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::social_site.show', compact('socialSite'));
    }

    /**
     * Show socialSite.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get socialSite
        $socialSite = $this->socialSiteService->find($id);
        // check if socialSite doesn't exists
        if (empty($socialSite)) {
            // flash notification
            notifier()->error('SocialSite not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::social_site.edit', compact('socialSite'));
    }

    /**
     * Update socialSite
     *
     * @param SocialSiteUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SocialSiteUpdateRequest $request, $id)
    {
        // get socialSite
        $socialSite = $this->socialSiteService->find($id);
        // check if socialSite doesn't exists
        if (empty($socialSite)) {
            // flash notification
            notifier()->error('SocialSite not found!');
            // redirect back
            return redirect()->back();
        }
        // update socialSite
        $socialSite = $this->socialSiteService->update($request->all(), $id);
        // check if socialSite updated
        if ($socialSite) {
            // flash notification
            notifier()->success('SocialSite updated successfully.');
        } else {
            // flash notification
            notifier()->error('SocialSite cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete socialSite
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get socialSite
        $socialSite = $this->socialSiteService->find($id);
        // check if socialSite doesn't exists
        if (empty($socialSite)) {
            // flash notification
            notifier()->error('SocialSite not found!');
            // redirect back
            return redirect()->back();
        }
        // delete socialSite
        if ($this->socialSiteService->delete($id)) {
            // flash notification
            notifier()->success('SocialSite deleted successfully.');
        } else {
            // flash notification
            notifier()->success('SocialSite cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
