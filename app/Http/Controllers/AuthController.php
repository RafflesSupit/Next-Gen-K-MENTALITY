<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            if(Auth::user()->role === "admin"){
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email'=>'Login gagal'
        ]);
        
    }

    public function showRegisterForm()
    {
        //
        return view('auth.register');
    }


    public function register(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $role = User::count() === 0 ? 'admin':'customer';

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        return redirect()->route('login');
    }

    
    public function logout(Request $request)
    {
        //
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect ()->route('home');
    }

    
}
