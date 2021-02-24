<?php

namespace Modules\Ums\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserResidentialInfoStoreRequest;
use Modules\Ums\Http\Requests\UserResidentialInfoUpdateRequest;

// datatable...
use Modules\Ums\DataTables\Profile\UserResidentialInfoDataTable;

// services...
use Modules\Ums\Services\UserResidentialInfoService;
use Modules\Ums\Services\UserService;

class ResidentialInfoController extends Controller
{
    /**
     * @var $userResidentialInfoService
     */
    protected $userResidentialInfoService;

    /**
     * Constructor
     *
     * @param UserResidentialInfoService $userResidentialInfoService
     */
    public function __construct(UserResidentialInfoService $userResidentialInfoService)
    {
        $this->userResidentialInfoService = $userResidentialInfoService;
    }

    /**
     * UserBasicInfo list
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // first or create user residential info
        $userResidentialInfo = $this->userResidentialInfoService->firstOrCreate([
            'user_id' => auth()->user()->id
        ]);
        // return view
        return view('ums::profile.residential-info.index', compact('userResidentialInfo'));
    }

    /**
     * Store userResidentialInfo
     *
     * @param UserResidentialInfoStoreRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserResidentialInfoStoreRequest $request, $id)
    {
        // create userResidentialInfo
        $userResidentialInfo = $this->userResidentialInfoService->update($request->all(), $id);
        // check if userResidentialInfo created
        if ($userResidentialInfo) {
            // flash notification
            notifier()->success('Your Residential Info updated successfully.');
        } else {
            // flash notification
            notifier()->error('Your Residential Info cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
