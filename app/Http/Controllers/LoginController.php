<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            activity()->causedBy($user)
                ->event("login")
                ->log(auth()->user()->name . ' melakukan login');
 
            
            return redirect()->intended('/dashboard');
        }
 
        return back()->with('loginError', 'Login failed!');
    }

    public function logout()
    {
        Auth::logout();

        
 
        request()->session()->invalidate();
    
        request()->session()->regenerateToken();
    
        return redirect('/');
    }
}
