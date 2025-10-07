<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        return view('adminSection.dashboard');
    }
    public function dashboard()
    {        
        return view('adminSection.content.dashboard.dashboards-crm');
    }
    public function roles()
    {        
        return view('adminSection.roles.index');
    }
}
