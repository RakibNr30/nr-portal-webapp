<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Cms\Http\Requests\QuoteStoreRequest;
use Modules\Cms\Http\Requests\QuoteUpdateRequest;

// datatable...
use Modules\Cms\Datatables\QuoteDatatable;

// services...
use Modules\Cms\Services\QuoteService;

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
     * Quote list
     *
     * @param QuoteDatatable $datatable
     * @return \Illuminate\View\View
     */
    public function index(QuoteDatatable $datatable)
    {
        return $datatable->render('cms::quote.index');
    }

    /**
     * Create quote
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('cms::quote.create');
    }


    /**
     * Store quote
     *
     * @param QuoteStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(QuoteStoreRequest $request)
    {
        // create quote
        $quote = $this->quoteService->create($request->all());
        // upload files
        $quote->uploadFiles();
        // check if quote created
        if ($quote) {
            // flash notification
            notifier()->success('Quote created successfully.');
        } else {
            // flash notification
            notifier()->error('Quote cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show quote.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get quote
        $quote = $this->quoteService->find($id);
        // check if quote doesn't exists
        if (empty($quote)) {
            // flash notification
            notifier()->error('Quote not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::quote.show', compact('quote'));
    }

    /**
     * Show quote.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get quote
        $quote = $this->quoteService->find($id);
        // check if quote doesn't exists
        if (empty($quote)) {
            // flash notification
            notifier()->error('Quote not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('cms::quote.edit', compact('quote'));
    }

    /**
     * Update quote
     *
     * @param QuoteUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(QuoteUpdateRequest $request, $id)
    {
        // get quote
        $quote = $this->quoteService->find($id);
        // check if quote doesn't exists
        if (empty($quote)) {
            // flash notification
            notifier()->error('Quote not found!');
            // redirect back
            return redirect()->back();
        }
        // update quote
        $quote = $this->quoteService->update($request->all(), $id);
        // upload files
        $quote->uploadFiles();
        // check if quote updated
        if ($quote) {
            // flash notification
            notifier()->success('Quote updated successfully.');
        } else {
            // flash notification
            notifier()->error('Quote cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete quote
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get quote
        $quote = $this->quoteService->find($id);
        // check if quote doesn't exists
        if (empty($quote)) {
            // flash notification
            notifier()->error('Quote not found!');
            // redirect back
            return redirect()->back();
        }
        // delete quote
        if ($this->quoteService->delete($id)) {
            // flash notification
            notifier()->success('Quote deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Quote cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
