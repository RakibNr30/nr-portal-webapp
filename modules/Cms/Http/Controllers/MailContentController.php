<?php

namespace Modules\Cms\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Cms\Http\Requests\MailContentUpdateRequest;
use Modules\Cms\Services\MailContentService;

class MailContentController extends Controller
{
    /**
     * @var $userService
     */
    protected $mailContentService;

    /**
     * Constructor
     *
     * @param MailContentService $mailContentService
     */
    public function __construct(MailContentService $mailContentService)
    {
        $this->mailContentService = $mailContentService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (\request()->has('mail_category')) {
            $mailContent = $this->mailContentService->findBy('mail_category_id', \request()->get('mail_category'));
        }
        else {
            $mailContent = $this->mailContentService->first();
        }
        // return view
        return view('cms::mail-template.index', compact('mailContent'));
    }

    /**
     * Update the specified resource in storage.
     * @param MailContentUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MailContentUpdateRequest $request, $id)
    {
        // update mailContent
        $mailContent = $this->mailContentService->update($request->all(), $id);
        // check if mailContent created
        if ($mailContent) {
            // flash notification
            notifier()->success('Mail Template updated successfully.');
        } else {
            // flash notification
            notifier()->error('Mail Template cannot be Updated.');
        }
        // redirect back
        return redirect()->back();
    }
}
