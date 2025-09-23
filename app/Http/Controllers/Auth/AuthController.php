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
        try {
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

            return response()->json([
                'success'=> true,
                'message'=> 'Berhasil register! Mohon lakukan login untuk masuk.',
                'data'=> null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data'    => null
            ], 500);
        }
    }
    
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials',
                    'data'    => null
                ], 401);
            }

            $user = auth()->user();
            Auth::login($user);
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'data'    => [
                    'token' => $token,
                    'user'  => $user,
                    'role'  => $user->role,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data'    => null
            ], 500);
        }
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
