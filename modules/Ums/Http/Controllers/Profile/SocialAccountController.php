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
        return $datatable->render('ums::profile.social-account.index');
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
        return view('ums::profile.social-account.create', compact('socialSites'));
    }


    /**
     * Store userSocialAccount
     *
     * @param UserSocialAccountStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserSocialAccountStoreRequest $request)
    {
        // get data
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        // create userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->create($data);
        // check if userSocialAccount created
        if ($userSocialAccount) {
            // flash notification
            notifier()->success('Your Social Account created successfully.');
        } else {
            // flash notification
            notifier()->error('Your Social Account cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
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
            notifier()->error('Your Social Account not found!');
            // redirect back
            return redirect()->back();
        }

        if (!($userSocialAccount->user_id == auth()->user()->id)) {
            return redirect()->to('/');
        }

        // return view
        return view('ums::profile.social-account.edit', compact('socialSites', 'userSocialAccount'));
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
            notifier()->error('Your Social Account not found!');
            // redirect back
            return redirect()->back();
        }
        // update userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->update($request->all(), $id);
        // check if userSocialAccount updated
        if ($userSocialAccount) {
            // flash notification
            notifier()->success('Your Social Account updated successfully.');
        } else {
            // flash notification
            notifier()->error('Your Social Account cannot be updated successfully.');
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
            notifier()->error('Your Social Account not found!');
            // redirect back
            return redirect()->back();
        }
        // delete userSocialAccount
        if ($this->userSocialAccountService->delete($id)) {
            // flash notification
            notifier()->success('Your Social Account deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Your Social Account cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
