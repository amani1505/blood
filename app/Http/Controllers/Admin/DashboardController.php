<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function donor()
    {
        return view('admin.donor');
    }
    public function addDonor()
    {
        return view('admin.addDonor');
    }
}
