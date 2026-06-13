<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }

    public function proses(Request $request){
        $kredensial = [
            'user_name' => $request->user_name,
            'password' => $request->password,
        ];

        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            $request->session()->put(
                'waktu_login',
                now()
                ->timezone('Asia/Jakarta')
                ->locale('id')
                ->isoFormat('dddd, D MMMM Y | HH:mm')
            );
            return redirect()->route('dashboard');
        }
        return back()->withErrors([
            'gagal' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login'); 
    }
}
