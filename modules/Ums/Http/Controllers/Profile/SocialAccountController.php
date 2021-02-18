<?php

namespace Modules\Ums\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserSocialAccountStoreRequest;
use Modules\Ums\Http\Requests\UserSocialAccountUpdateRequest;

// datatable...
use Modules\Ums\DataTables\Profile\SocialAccountDataTable;

// services...
use Modules\Ums\Services\SocialSiteService;
use Modules\Ums\Services\UserSocialAccountService;

class SocialAccountController extends Controller
{
    /**
     * @var $socialSiteService
     */
    protected $socialSiteService;

    /**
     * @var $userSocialAccountService
     */
    protected $userSocialAccountService;

    /**
     * Constructor
     *
     * @param SocialSiteService $socialSiteService
     * @param UserSocialAccountService $userSocialAccountService
     */
    public function __construct(SocialSiteService $socialSiteService, UserSocialAccountService $userSocialAccountService)
    {
        $this->socialSiteService = $socialSiteService;
        $this->userSocialAccountService = $userSocialAccountService;
    }

    /**
     * UserSocialAccount list
     *
     * @param SocialAccountDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(SocialAccountDataTable $datatable)
    {
        return $datatable->render('ums::profile.social_account.index');
    }

    /**
     * Create userSocialAccount
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // social sites
        $socialSites = $this->socialSiteService->all();
        // return view
        return view('ums::profile.social_account.create', compact('socialSites'));
    }


    /**
     * Store userSocialAccount
     *
     * @param UserSocialAccountStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserSocialAccountStoreRequest $request)
    {
        // create userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->create($request->all());
        // check if userSocialAccount created
        if ($userSocialAccount) {
            // flash notification
            notifier()->success('UserSocialAccount created successfully.');
        } else {
            // flash notification
            notifier()->error('UserSocialAccount cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show userSocialAccount.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->find($id);
        // check if userSocialAccount doesn't exists
        if (empty($userSocialAccount)) {
            // flash notification
            notifier()->error('UserSocialAccount not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::profile.social_account.show', compact('userSocialAccount'));
    }

    /**
     * Show userSocialAccount.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // social sites
        $socialSites = $this->socialSiteService->all();
        // get userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->find($id);
        // check if userSocialAccount doesn't exists
        if (empty($userSocialAccount)) {
            // flash notification
            notifier()->error('UserSocialAccount not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::profile.social_account.edit', compact('socialSites', 'userSocialAccount'));
    }

    /**
     * Update userSocialAccount
     *
     * @param UserSocialAccountUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserSocialAccountUpdateRequest $request, $id)
    {
        // get userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->find($id);
        // check if userSocialAccount doesn't exists
        if (empty($userSocialAccount)) {
            // flash notification
            notifier()->error('UserSocialAccount not found!');
            // redirect back
            return redirect()->back();
        }
        // update userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->update($request->all(), $id);
        // check if userSocialAccount updated
        if ($userSocialAccount) {
            // flash notification
            notifier()->success('UserSocialAccount updated successfully.');
        } else {
            // flash notification
            notifier()->error('UserSocialAccount cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete userSocialAccount
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->find($id);
        // check if userSocialAccount doesn't exists
        if (empty($userSocialAccount)) {
            // flash notification
            notifier()->error('UserSocialAccount not found!');
            // redirect back
            return redirect()->back();
        }
        // delete userSocialAccount
        if ($this->userSocialAccountService->delete($id)) {
            // flash notification
            notifier()->success('UserSocialAccount deleted successfully.');
        } else {
            // flash notification
            notifier()->success('UserSocialAccount cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
