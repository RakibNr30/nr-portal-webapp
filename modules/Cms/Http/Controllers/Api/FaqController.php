<?php

namespace Modules\Cms\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Cms\Services\FaqService;

// requests...
use Modules\Cms\Http\Requests\FaqStoreRequest;
use Modules\Cms\Http\Requests\FaqUpdateRequest;

// resources...
use Modules\Cms\Transformers\FaqResource;

class FaqController extends Controller
{
    /**
     * @var $faqService
     */
    protected $faqService;

    /**
     * Constructor
     *
     * @param FaqService $faqService
     */
    public function __construct(FaqService $faqService)
    {
        $this->faqService = $faqService;
    }

    /**
     * Faq list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all faqs
        $faqs = $this->faqService->all(request()->get('limit') ?? 0);
        // if no faq found
        if (!count($faqs)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('Faq not available.');
        }
        // transform faqs
        $faqs = FaqResource::collection($faqs);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($faqs);
    }

    /**
     * Store a faq.
     *
     * @param FaqStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqStoreRequest $request)
    {
        // create faq
        $faq = $this->faqService->create($request->all());
        // check if created
        if ($faq) {
            // transform faq
            $faq = FaqResource::make($faq);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('Faq created successfully.')
                ->data($faq);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Faq cannot be created.');
        }
    }

    /**
     * Show faq.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get faq
        $faq = $this->faqService->find($id);
        // if no faq found
        if (empty($faq)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Faq not found.');
        }
        // transform faq
        $faq = FaqResource::make($faq);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Faq is available.')
            ->data($faq);
    }

    /**
     * Update faq.
     *
     * @param FaqUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(FaqUpdateRequest $request, $id)
    {
        // get faq
        $faq = $this->faqService->find($id);
        // if no faq found
        if (empty($faq)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Faq not found.');
        }
        // update faq
        $faq = $this->faqService->update($request->all(), $id);
        // check if updated
        if ($faq) {
            // get updated faq
            $faq = $this->faqService->find($id);
            // transform faq
            $faq = FaqResource::make($faq);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Faq updated successfully.')
                ->data($faq);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Faq cannot be updated.');
        }
    }

    /**
     * Remove faq.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get faq
        $faq = $this->faqService->find($id);
        // if no faq found
        if (empty($faq)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Faq not found.');
        }
        // delete faq
        if ($this->faqService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Faq deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Faq cannot be deleted.');
        }
    }
}
