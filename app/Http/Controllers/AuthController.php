<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the login credentials
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('username', 'password'))) {
            $role = Auth::user()->role;

            // Redirect based on the role
            if ($role === 'Orang Tua') {
                return redirect()->route('dashboard.orangtua');
            } elseif (in_array($role, ['Dosen', 'Keasramaan', 'Kemahasiswaan'])) {
                return redirect()->route('dashboard.admin');
            }

            // Optional: If no matching role
            return redirect()->route('login');
        }


        // Authentication failed, redirect back with an error
        return back()->withErrors(['username' => 'Invalid credentials.'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
