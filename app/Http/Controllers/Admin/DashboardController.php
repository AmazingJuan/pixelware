<?php

/*
 * DashboardController.php
 * Controller for managing the admin dashboard.
 * Author: Santiago Manco
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $users = User::all();

        return view('admin.dashboard.index', compact('users'));
    }
}
