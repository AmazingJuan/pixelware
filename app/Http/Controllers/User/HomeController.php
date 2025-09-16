<?php

/*
 * HomeController.php
 * Controller for managing the home page in the application.
 * Author: Juan Avendaño
*/

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('user.home.index');
    }
}
