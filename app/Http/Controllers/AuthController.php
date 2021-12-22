<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function register()
    {
        if (Auth::user()) {
            return redirect()->route('home');
        }
        return view('auth.register');
    }

    public function company_register()
    {
        return view('admin.user.register_company');
    }

    public function register_process(RegisterRequest $request)
    {
        // dd($request);


        $this->userService->create($request->all());
        return redirect()->back()->with('success', 'Akun berhasil terbuat');
    }
    public function login()
    {
        if (Auth::user()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login_process(Request $request)
    {

        request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $role = Auth::user()->role;
            if ($role == 'Admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($role == 'Member' || $role == 'Company') {
                return redirect()->intended('/');
            }
            return redirect('/');
        }

        return redirect('login')->with('error', 'Login gagal.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logout Berhasil');
    }
}
