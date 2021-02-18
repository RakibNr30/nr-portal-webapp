<?php

namespace Modules\Ums\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Ums\Services\SocialSiteService;

// requests...
use Modules\Ums\Http\Requests\SocialSiteStoreRequest;
use Modules\Ums\Http\Requests\SocialSiteUpdateRequest;

// resources...
use Modules\Ums\Transformers\SocialSiteResource;

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
    }

    /**
     * SocialSite list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all socialSites
        $socialSites = $this->socialSiteService->all(request()->get('limit') ?? 0);
        // if no socialSite found
        if (!count($socialSites)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('SocialSite not available.');
        }
        // transform socialSites
        $socialSites = SocialSiteResource::collection($socialSites);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($socialSites);
    }

    /**
     * Store a socialSite.
     *
     * @param SocialSiteStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocialSiteStoreRequest $request)
    {
        // create socialSite
        $socialSite = $this->socialSiteService->create($request->all());
        // check if created
        if ($socialSite) {
            // transform socialSite
            $socialSite = SocialSiteResource::make($socialSite);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('SocialSite created successfully.')
                ->data($socialSite);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('SocialSite cannot be created.');
        }
    }

    /**
     * Show socialSite.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get socialSite
        $socialSite = $this->socialSiteService->find($id);
        // if no socialSite found
        if (empty($socialSite)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('SocialSite not found.');
        }
        // transform socialSite
        $socialSite = SocialSiteResource::make($socialSite);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('SocialSite is available.')
            ->data($socialSite);
    }

    /**
     * Update socialSite.
     *
     * @param SocialSiteUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocialSiteUpdateRequest $request, $id)
    {
        // get socialSite
        $socialSite = $this->socialSiteService->find($id);
        // if no socialSite found
        if (empty($socialSite)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('SocialSite not found.');
        }
        // update socialSite
        $socialSite = $this->socialSiteService->update($request->all(), $id);
        // check if updated
        if ($socialSite) {
            // get updated socialSite
            $socialSite = $this->socialSiteService->find($id);
            // transform socialSite
            $socialSite = SocialSiteResource::make($socialSite);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('SocialSite updated successfully.')
                ->data($socialSite);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('SocialSite cannot be updated.');
        }
    }

    /**
     * Remove socialSite.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get socialSite
        $socialSite = $this->socialSiteService->find($id);
        // if no socialSite found
        if (empty($socialSite)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('SocialSite not found.');
        }
        // delete socialSite
        if ($this->socialSiteService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('SocialSite deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('SocialSite cannot be deleted.');
        }
    }
}
