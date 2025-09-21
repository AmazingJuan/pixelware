<?php

/*
 * DashboardController.php
 * Controller for managing the admin dashboard.
 * Author: Santiago Manco
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(): View
    {

        return view('admin.dashboard.index');
    }
}
