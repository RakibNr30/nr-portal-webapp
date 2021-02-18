<?php

namespace Modules\Cms\Http\Controllers\Api;

use App\Http\Controllers\Controller;

// services...
use Modules\Cms\Services\QuoteService;

// requests...
use Modules\Cms\Http\Requests\QuoteStoreRequest;
use Modules\Cms\Http\Requests\QuoteUpdateRequest;

// resources...
use Modules\Cms\Transformers\QuoteResource;

class QuoteController extends Controller
{
    /**
     * @var $quoteService
     */
    protected $quoteService;

    /**
     * Constructor
     *
     * @param QuoteService $quoteService
     */
    public function __construct(QuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
    }

    /**
     * Quote list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all quotes
        $quotes = $this->quoteService->all(request()->get('limit') ?? 0);
        // if no quote found
        if (!count($quotes)) {
            // error response
            return responder()
                ->status('success')
                ->code(404)
                ->message('Quote not available.');
        }
        // transform quotes
        $quotes = QuoteResource::collection($quotes);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Data available')
            ->data($quotes);
    }

    /**
     * Store a quote.
     *
     * @param QuoteStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuoteStoreRequest $request)
    {
        // create quote
        $quote = $this->quoteService->create($request->all());
        // check if created
        if ($quote) {
            // transform quote
            $quote = QuoteResource::make($quote);
            // success response
            return responder()
                ->status('success')
                ->code(201)
                ->message('Quote created successfully.')
                ->data($quote);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Quote cannot be created.');
        }
    }

    /**
     * Show quote.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get quote
        $quote = $this->quoteService->find($id);
        // if no quote found
        if (empty($quote)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Quote not found.');
        }
        // transform quote
        $quote = QuoteResource::make($quote);
        // success response
        return responder()
            ->status('success')
            ->code(200)
            ->message('Quote is available.')
            ->data($quote);
    }

    /**
     * Update quote.
     *
     * @param QuoteUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuoteUpdateRequest $request, $id)
    {
        // get quote
        $quote = $this->quoteService->find($id);
        // if no quote found
        if (empty($quote)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Quote not found.');
        }
        // update quote
        $quote = $this->quoteService->update($request->all(), $id);
        // check if updated
        if ($quote) {
            // get updated quote
            $quote = $this->quoteService->find($id);
            // transform quote
            $quote = QuoteResource::make($quote);
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Quote updated successfully.')
                ->data($quote);
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Quote cannot be updated.');
        }
    }

    /**
     * Remove quote.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get quote
        $quote = $this->quoteService->find($id);
        // if no quote found
        if (empty($quote)) {
            // error response
            return responder()
                ->status('error')
                ->code(404)
                ->message('Quote not found.');
        }
        // delete quote
        if ($this->quoteService->delete($id)) {
            // success response
            return responder()
                ->status('success')
                ->code(200)
                ->message('Quote deleted successfully.');
        } else {
            // error response
            return responder()
                ->status('error')
                ->code(400)
                ->message('Quote cannot be deleted.');
        }
    }
}
