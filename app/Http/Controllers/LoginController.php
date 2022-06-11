<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function check(Request $request)
    {
        //validation
        $request->validate([
            'username'=>'required|min:4|max:10',
            'password'=>'required|min:7|max:20',
        ]);

        $userInfo = User::where('username', '=', $request->username)->first();
       
            if (!$userInfo){
                return back()->with('fail', 'Δεν υπάρχει χρήστης με αυτό το Όνομα' );
            }
            elseif ( $userInfo->admin !== "yes"){
                return back()->with('fail', 'Δεν υπάρχει διαχειριστής με αυτό το Όνομα' );
            }
            
            else {
                if (Hash::check($request->password,$userInfo->password)){
                    $request->session()->put("LoggedUser", $userInfo->id);
                    return redirect('dashboard');
                }
                else {
                    return back()->with('fail', 'Λάθος κωδικός χρήστη' );
                }
            }
        
    }

   

   

   
}
