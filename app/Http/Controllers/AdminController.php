<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function logout(){
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('login');
        }
    }

    public function dashboard()
    {
        //$users = User::all();
        $users = User::where('admin', '!=', 'yes')->get();
        //$data = ['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))->first()];
        return view('dashboard',compact('users'));
    }
}
