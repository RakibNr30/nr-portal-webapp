<?php

namespace Modules\Ums\Http\Controllers;

use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('ums::dashboard.index');
    }
}
