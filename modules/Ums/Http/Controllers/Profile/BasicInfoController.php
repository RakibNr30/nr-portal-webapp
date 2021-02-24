<?php

namespace Modules\Ums\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserBasicInfoStoreRequest;

// services...
use Modules\Ums\Services\UserBasicInfoService;

class BasicInfoController extends Controller
{
    /**
     * @var $userBasicInfoService
     */
    protected $userBasicInfoService;

    /**
     * Constructor
     *
     * @param UserBasicInfoService $userBasicInfoService
     */
    public function __construct(UserBasicInfoService $userBasicInfoService)
    {
        $this->userBasicInfoService = $userBasicInfoService;
    }

    /**
     * UserBasicInfo list
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // first or create user personal info
        $userBasicInfo = $this->userBasicInfoService->firstOrCreate([
            'user_id' => auth()->user()->id
        ]);
        // return view
        return view('ums::profile.basic-info.index', compact('userBasicInfo'));
    }

    /**
     * Store userBasicInfo
     *
     * @param UserBasicInfoStoreRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserBasicInfoStoreRequest $request, $id)
    {
        // create userBasicInfo
        $userBasicInfo = $this->userBasicInfoService->update($request->all(), $id);
        // upload files
        $userBasicInfo->uploadFiles();
        // check if userBasicInfo created
        if ($userBasicInfo) {
            // flash notification
            notifier()->success('Your Basic Info updated successfully.');
        } else {
            // flash notification
            notifier()->error('Your Basic Info cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
