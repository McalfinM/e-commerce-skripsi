<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TwoFAController extends Controller
{
    public function index()
    {
        return view('2fa.index');
    }

    public function create(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $find = Otp::where('user_id', auth()->user()->id)
            ->where('code', $request->code)
            ->where('updated_at', '>=', now()->subSecond(20))
            ->first();

        if (!is_null($find)) {
            Session::put('user_2fa', auth()->user()->id);
            if (auth()->user()->role == 'Company') {
                return redirect()->route('company_dashboard');
            } else {
                return redirect()->route('dashboard');
            }
        }

        return back()->with('error', 'You entered wrong code.');
    }

    public function resend()
    {
        $find = Otp::where('user_id', auth()->user()->id)
            ->where('updated_at', '>=', now()->subSecond(20))
            ->first();
        if (!$find) {
            auth()->user()->generateCode();
            return back()->with('success', 'Kode verifikasi berhasil dikirim');
        } else {
            return back()->with('error', 'Tunggu beberapa saat untuk meminta ulang kode');
        }
    }
}
