<?php

/*
 * HomeController.php
 * Controller for managing the home page in the application.
 * Author: Juan Avendaño
*/

namespace App\Http\Controllers\User;

// Laravel / framework
use Illuminate\View\View;

// App
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(): View
    {
        // Return the view for the home page

        return view('user.home.index');
    }
}
