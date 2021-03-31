<?php

namespace Modules\Cms\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Cms\Services\DashboardService;
use Modules\Ums\Entities\User;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
        $this->middleware(['permission:dashboard']);
    }

    public function index()
    {
        $data = new \stdClass();
        $user = User::find(auth()->user()->id);

        if ($user->hasRole('client')) {
            $data = $this->dashboardService->clientWidget();
        }
        if ($user->hasRole('company')) {
            $data = $this->dashboardService->companyWidget();
        }
        if ($user->hasRole('admin') || $user->hasRole('super_admin') ) {
            $data = $this->dashboardService->adminWidget();
        }

        return view('cms::dashboard.index', compact('data'));
    }
}
