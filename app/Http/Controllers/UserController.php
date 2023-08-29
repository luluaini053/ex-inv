<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Depart;
use App\Models\InvLogs;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $invlog = InvLogs::with(['user', 'inv'])->where('user_id', Auth::user()->id)->get();
        return view('profile', ['inv_log' => $invlog]);
    }

    public function users(Request $request)
    {
        $users = User::where('role_id', 2)->where('status', 'active')->get();
        $depart = Depart::all();
        return view('user', ['users' => $users, 'depart' => $depart]);
    }


    public function registeredUser(){
        $registeredUser = User::where('status', 'inactive')->where('role_id', 2)->get();
        $depart = Str::upper('user_departs');
        return view('registered-user', ['registeredUsers' => $registeredUser, 'user_departs' => $depart]);
    }

    public function show($slug){

        $user = User::where('slug', $slug)->first();
        $invlog = InvLogs::with(['user', 'inv'])->where('user_id', $user->id)->get();
        return view('user-detail', ['user' => $user, 'inv_log' => $invlog]);
    }

    public function approve($slug){
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();
        return redirect('user-detail/'.$slug)->with('status', 'User Approved Success');
    }

    public function banned($slug){
        $user = User::where('slug', $slug)->first();
        return view('user-banned', ['user' => $user]);
    }

    public function eliminate($slug){
        $user = User::where('slug', $slug)->first();
        $user->delete();
        return redirect('users')->with('status', 'Banned User Success');
    }

    public function banUser(){
        $banUser = User::onlyTrashed()->get();
        return view('user-banned-list', ['banUser' => $banUser]);
    }

    public function unbanned($slug){
        $user = User::withTrashed()->where('slug', $slug)->first();
        $user->restore();
        return redirect('users')->with('status', 'Unbanned User Success');
    }
}
