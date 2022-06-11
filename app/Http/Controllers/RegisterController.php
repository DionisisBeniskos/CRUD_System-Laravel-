<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function save(Request $request)
    {
        //validation
        $request->validate(
            [
            'fullname'=>'required|min:4|max:30',
            'username'=>'required|min:4|max:10|unique:users',
            'email'=>'required|email|unique:users|min:5|max:40',
            'password'=>'required|min:7|max:70',
            ],
            [
                'fullname.required'=>'Το Ονοματεπώνυμο είναι υποχρεωτικό',
                'fullname.min'=>'Το Ονοματεπώνυμο πρέπει να περιέχει από 4 μέχρι 30 χαρακτήρες',
                'fullname.max'=>'Το Ονοματεπώνυμο πρέπει να περιέχει από 4 μέχρι 30 χαρακτήρες',
                'username.required'=>'Το Όνομα Χρήστη είναι υποχρεωτικό',
                'username.min'=>'Το Όνομα Χρήστη πρέπει να περιέχει από 4 μέχρι 20 χαρακτήρες',
                'username.max'=>'Το Όνομα Χρήστη πρέπει να περιέχει από 4 μέχρι 20 χαρακτήρες',
                'username.unique'=>'Το Όνομα Χρήστη υπάρχει ήδη.Παρακαλώ χρησημοποιήστε διαφορετικό Όνομα Χρήστη',
                'email.required'=>'Το email είναι υποχρεωτικό',
                'email.email'=>'Παρακαλώ εισάγετε μία έγκιρη διεύθυνση email',
                'email.unique'=>'Το email υπάρχει ήδη.Παρακαλώ χρησiμοποιήστε διαφορετικό email',
                'email.min'=>'To email να περιέχει από 5 μέχρι 40 χαρακτήρες',
                'email.max'=>'To email να περιέχει από 5 μέχρι 40 χαρακτήρες',
                'password.required'=>'Ο κωδικός είναι υποχρεωτικός',
                'password.min'=>'Ο κωδικός πρέπει να περιέχει από 7 μέχρι 70 χαρακτήρες',
                'password.max'=>'Ο κωδικός πρέπει να περιέχει από 7 μέχρι 70 χαρακτήρες',
            ]
        );

        //Insert values to databese
        $user = new User;
        $user->fullname = $request->fullname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->active = json_encode($request->active);
        $user->admin = "no";
        $user->roles = json_encode($request->roles);
        $user->password = Hash::make($request->password);
        $save = $user->save();

        if ($save) {
            return back()->with('success','Η εγγραφή σας ολοκληρώθηκε');
        }
        else {
            return back()->with('fail','Κάτι δεν πήγε σωστά, ξανά δοκιμάστε αργότερα');
        }
    }
}
