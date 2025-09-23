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
    public function index(): View
    {
        // Display the admin dashboard
        return view('admin.dashboard.index');
    }
}
