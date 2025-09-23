<?php

/*
 * DashboardController.php
 * Controller for managing the admin dashboard.
 * Author: Santiago Manco
*/

namespace App\Http\Controllers\Admin;

// Laravel / framework
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    // Display the admin dashboard
    public function index(): View
    {
        return view('admin.dashboard.index');
    }
}
