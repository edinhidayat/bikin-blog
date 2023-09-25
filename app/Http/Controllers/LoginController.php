<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login',[
            'title' => 'Login'
        ]);
    }

    public function login(Request $request)
    {
        $pengguna = User::where('username', $request->username)->get();
        // dd($pengguna[0]['aktif']);
        
        if(isset($pengguna[0]['username'])){
            if($pengguna[0]['aktif'] === 0){
                // Kalau User Tidak Aktif
                return redirect('/login')->with('notregister','User Belum Aktif');
            }
            // Kalau User Aktif
            $credentials = $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }
            return back()->with('gagal', 'Username / Password Salah');
        }
        return back()->with('gagal', 'Username / Password Salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login')->with('keluar', 'Anda berhasil Logout');
    }
}
