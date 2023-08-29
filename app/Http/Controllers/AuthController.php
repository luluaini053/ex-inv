<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Depart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        $departements = Depart::all();
        return view('register',["depts" => $departements]);
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        //cek apakah login valid
        if (Auth::attempt($credentials)) {
            //cek status user = active
            if(Auth::user()->status != 'active'){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                Session::flash('status', 'failed');
                Session::flash('message', 'Your account is not active yet, please contact admin');
                return redirect('/login');
            }

            $request->session()->regenerate();
            if(Auth::user()->role_id == 1){
                return redirect('dashboard');
            }
            if(Auth::user()->role_id == 2){
                return redirect('profile');
            }

            //s
            //return redirect('');
        }
        Session::flash('status', 'failed');
        Session::flash('message', 'Login invalid');
        return redirect('login');

    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function registerProcess(Request $request){
        // dd($request);
        $validate = $request->validate([
            'username' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
            'divisi' => 'required',
        ]);

        $registerData = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'depart_id' => $request->divisi,
        ];

        $user = User::create($registerData);
        // $request['divisi'] = Str::upper($request->divisi);
        //$divisi = strtoupper($divisi);
        //if (strtoupper($divisi) !== $divisi) {
        //    $fail('validation.uppercase')->translate();
        //}

        Session::flash('status', 'success');
        Session::flash('message', 'Register Success. Wait admin for approval');
        return redirect('register');
    }
}
