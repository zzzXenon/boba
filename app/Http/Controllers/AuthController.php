<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.loginMain');
    }

    public function showOrangTuaLoginForm()
    {
        return view('auth.loginOrtu');
    }

    public function showKeasramaanLoginForm()
    {
        return view('auth.loginKeasramaan');
    }

    public function showKemahasiswaanLoginForm()
    {
        return view('auth.loginKemahasiswaan');
    }

    public function showDosenLoginForm()
    {
        return view('auth.loginDosen');
    }

    public function login(Request $request)
    {
        // Validate user input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Log the input for debugging (optional)
        Log::info('Login attempt:', ['username' => $request->username]);

        try {
            // Retrieve the user from the database by username
            $user = User::where('username', $request->username)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                // Log the successful login
                Log::info('Login successful:', ['user' => $user->username]);

                // Log in the user using Laravel's Auth
                Auth::login($user);

                // Redirect based on user role
                if (in_array($user->role, ['Orang Tua'])) {
                    return redirect()->route('admin')->with('success', 'Login sebagai Orang Tua berhasil');
                } else if (in_array($user->role, ['Keasramaan'])) {
                    return redirect()->route('admin')->with('success', 'Login sebagai Keasramaan berhasil');
                } else if (in_array($user->role, ['Kemahasiswaan'])) {
                    return redirect()->route('admin')->with('success', 'Login sebagai Kemahasiswaan berhasil');
                } else if (in_array($user->role, ['Dosen'])) {
                    return redirect()->route('beranda')->with('success', 'Login sebagai Dosen berhasil');
                }
            }

            // Handle failed authentication
            Log::warning('Login failed:', ['username' => $request->username]);
            return back()->withErrors(['login' => 'Username atau Password salah.']);
        } catch (\Exception $e) {
            // Handle errors during authentication
            Log::error('Login error:', ['message' => $e->getMessage()]);
            return back()->withErrors(['login' => 'Terjadi kesalahan saat login.']);
        }
    }

    public function processOrangTuaLogin(Request $request)
    {
        ]);

        // Attempt login for the 'orangtua' guard
        if (Auth::guard('orangtua')->attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])) {
            // Redirect to the student info page if successful
            return redirect()->route('info.mahasiswa')->with('success', 'Login berhasil!');
        if (Auth::attempt($validated)) {
            // Assume the authenticated parent is linked to a student ID
            $studentId = Auth::user()->student_id; // Example field for student's ID

            return redirect()->route('info.mahasiswa', ['id' => $studentId]);
        }

        // If login fails, redirect back with an error message
    }


    public function logout()
    {
        session()->flush(); // Hapus semua data session
        session()->regenerate(); // Regenerate session ID untuk keamanan
        return redirect()->route('login');
    }
}
