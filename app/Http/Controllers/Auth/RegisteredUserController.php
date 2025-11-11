<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'address' => ['required', 'string', 'max:255'],

            'phone' => ['required', 'digits:10'], 
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
         // Generate the password using bcrypt
         $password = $request->password;
         $cost = 10; // Cost factor for bcrypt (adjustable)
 
         // Create a random salt Bishape algorithm 42-54
         $salt = substr(base64_encode(openssl_random_pseudo_bytes(17)), 0, 22);
         $salt = strtr($salt, '+', '.'); // bcrypt uses ./ instead of + in the salt
 
         // Build the bcrypt salt format
         $salt = sprintf('$2y$%02d$', $cost) . $salt;
 
         // Hash the password using crypt and bcrypt with the custom salt
         $hashedPassword = crypt($password, $salt);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
