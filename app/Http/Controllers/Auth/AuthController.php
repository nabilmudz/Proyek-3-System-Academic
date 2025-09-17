<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function showRegisterForm(){
        if(Auth::check()){
            $user = Auth::user();
            return $user->role === 'mahasiswa'
                ? redirect('/mahasiswa')
                : redirect('/admin');
        }   
        return view("auth.register");
    }
    public function showLoginForm(){
        return view("auth.login");
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'password' => 'required|string|min:6|confirmed'
        ]);

        User::create([
            'id' => Str::uuid(),
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect('/auth/login')->with('success', 'Akun didaftarkan! Mohon lakukan login.');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = JWTAuth::attempt($credentials)) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
            return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
        }

        $user = auth()->user();
        Auth::login($user);

        if ($request->expectsJson()) {
            return response()->json([
                'token' => $token,
                'role'  => $user->role,
                'user'  => $user
            ]);
        }

        return $user->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('mahasiswa.dashboard');
    }

    public function logout(Request $request){
        try {
            if (JWTAuth::getToken()) {
                JWTAuth::invalidate(JWTAuth::getToken());
            }
        } catch (\Exception $e) {
            // Ignore
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/auth/login')->with('success','Berhasil Logout!');
    }
}
