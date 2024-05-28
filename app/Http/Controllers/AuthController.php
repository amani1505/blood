<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (!Auth::user())
            return view('login');

        $user = Auth::user();
        return match ($user->role) {
            'HOSPITAL_ADMIN', 'CENTRAL_ADMIN' => redirect()->route('admin.dashboard')->with([
                'message' => 'Welcome Admin',
                'alert-type' => 'success',
            ]),
            default => redirect('/')->with([
                'message' => 'Please login',
                'alert-type' => 'error',
            ]),
        };
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (!Auth::attempt($credentials))
            return redirect('/')->with([
                'message' => 'User and password wrong',
                'alert-type' => 'error',
            ]);

        $user = Auth::user(); // Correct way to get the authenticated user
        if ($user->role === 'HOSPITAL_ADMIN' || $user->role === 'CENTRAL_ADMIN') {
            return redirect()->route('admin.dashboard')->with([
                'message' => 'Welcome Admin',
                'alert-type' => 'success',
            ]);
        } else {
            Auth::logout();
            return redirect('/')->with([
                'message' => 'Please login',
                'alert-type' => 'error',
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with([
            'message' => 'Success logout',
            'alert-type' => 'success',
        ]);
    }
}
