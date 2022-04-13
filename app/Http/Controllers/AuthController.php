<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PragmaRX\Google2FALaravel\Support\Authenticator;

class AuthController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('guest')->except('logout');
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
        $this->userService->create($request->all());
        return redirect()->back()->with('success', 'Akun berhasil terbuat');
    }
    public function login()
    {
        if (Auth::user()) {
            return redirect()->route('company_dashboard');
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
            auth()->user()->generateCode();
            if ($role == 'Admin') {
                return redirect()->route('2fa.index');
            } elseif ($role == 'Company') {
                return redirect()->route('2fa.index');
            }
        }

        return redirect('login')->with('error', 'Login gagal.');
    }

    public function logout()
    {

        Auth::logout();
        Session::remove('user_2fa');
        return redirect()->route('login')->with('success', 'Logout Berhasil');
    }
}
