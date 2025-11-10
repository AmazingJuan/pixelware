<?php

namespace App\Http\Controllers\Auth;

// Laravel / framework
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

// Application / Models
use App\Models\User;

// Application / Utils & Helpers
use App\Helpers\UserHelper;
use App\Http\Requests\RegisterUserRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \App\Http\Requests\RegisterUserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterUserRequest $request)
    {
        // Create the user using UserHelper
        $user = $this->create($request);

        $this->guard()->login($user);

        return redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  \App\Http\Requests\RegisterUserRequest  $request
     * @return \App\Models\User
     */
    protected function create(RegisterUserRequest $request): User
    {
        $validated = $request->validated();

        return UserHelper::create($validated);
    }
}
