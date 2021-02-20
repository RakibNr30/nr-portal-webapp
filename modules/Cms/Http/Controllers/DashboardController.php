<?php

namespace Modules\Cms\Http\Controllers;

use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('cms::dashboard.index');
    }
}
