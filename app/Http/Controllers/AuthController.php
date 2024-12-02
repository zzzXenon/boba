<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
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

        // Log input for debugging (optional)
        Log::info('Login attempt:', ['username' => $request->username]);

        try {
            // Send API request to the external authentication endpoint
            $client = new \GuzzleHttp\Client(['verify' => false]);

            $response = $client->post(env('EXTERNAL_API_URL', 'https://cis-dev.del.ac.id') . '/jwt-api/do-auth', [
                'form_params' => [
                    'username' => $request->username,
                    'password' => $request->password,
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            // Decode the API response
            $data = json_decode($response->getBody()->getContents(), true);

            if ($data && isset($data['result']) && $data['result'] === true) {
                // Extract token and user information
                $token = $data['token'];
                $user = $data['user'];

                // Store token and user info in session
                session(['api_token' => $token]);
                session(['user_api' => $user]);

                Log::info('Login successful:', ['user' => $user]);

                // Redirect based on user role
                if (in_array($user['role'], ['Dosen', 'Staff', 'Authenticated User'])) {
                    return redirect()->route('admin')->with('success', 'Login sebagai admin berhasil!');
                } else {
                    return redirect()->route('beranda')->with('success', 'Login berhasil!');
                }
            }

            // Handle failed authentication
            Log::error('Authentication failed:', ['response' => $data]);
            return back()->withErrors(['login' => 'Username atau Password salah.']);
        } catch (\Exception $e) {
            // Handle errors during the API call
            Log::error('API Error:', ['message' => $e->getMessage()]);
            return back()->withErrors(['login' => 'Terjadi kesalahan saat menghubungi API.']);
        }
    }


    public function logout()
    {
        session()->flush(); // Hapus semua data session
        session()->regenerate(); // Regenerate session ID untuk keamanan
        return redirect()->route('login');
    }
}
