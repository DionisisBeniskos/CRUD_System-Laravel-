<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function editUser($user_id){
        $user = User::find($user_id);
        return view('editUser', compact('user'));
    }

    
    public function updateUser(Request $request , $user_id){
        $user = User::find($user_id);

        //validation
        if($user->email !== $request->email){
            $request->validate([
                'email'=>'required|email|unique:users|min:5|max:40',
            ],
            [
                'email.required'=>'Το email είναι υποχρεωτικό',
                'email.email'=>'Παρακαλώ εισάγετε μία έγκιρη διεύθυνση email',
                'email.unique'=>'Το email υπάρχει ήδη.Παρακαλώ χρησiμοποιήστε διαφορετικό email',
                'email.min'=>'To email να περιέχει από 5 μέχρι 40 χαρακτήρες',
                'email.max'=>'To email να περιέχει από 5 μέχρι 40 χαρακτήρες',
            ]);
        }
        if($user->username !== $request->username){
            $request->validate([
                'username'=>'required|min:4|max:10|unique:users',
            ],
            [
                'username.required'=>'Το Όνομα Χρήστη είναι υποχρεωτικό',
                'username.min'=>'Το Όνομα Χρήστη πρέπει να περιέχει από 4 μέχρι 20 χαρακτήρες',
                'username.max'=>'Το Όνομα Χρήστη πρέπει να περιέχει από 4 μέχρι 20 χαρακτήρες',
                'username.unique'=>'Το Όνομα Χρήστη υπάρχει ήδη.Παρακαλώ χρησημοποιήστε διαφορετικό Όνομα Χρήστη',
            ]);
        }
        $request->validate([
            'fullname'=>'required|min:4|max:30',  
            'password'=>'required|min:7|max:70',
        ],
        [
            'fullname.required'=>'Το Ονοματεπώνυμο είναι υποχρεωτικό',
            'fullname.min'=>'Το Ονοματεπώνυμο πρέπει να περιέχει από 4 μέχρι 30 χαρακτήρες',
            'fullname.max'=>'Το Ονοματεπώνυμο πρέπει να περιέχει από 4 μέχρι 30 χαρακτήρες',
            'password.required'=>'Ο κωδικός είναι υποχρεωτικός',
            'password.min'=>'Ο κωδικός πρέπει να περιέχει από 7 μέχρι 70 χαρακτήρες',
            'password.max'=>'Ο κωδικός πρέπει να περιέχει από 7 μέχρι 70 χαρακτήρες',
        ]);

        if ($user){
            $user->fullname = $request->fullname;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->active = json_encode($request->active);
            $user->roles = json_encode($request->roles);
            if($user->password !== $request->password){
                $user->password = Hash::make($request->password);
            }
            $update = $user->update();
            return redirect('dashboard')->with('success','Τα στοιχεία του χρήστη ενημερώθηκαν');
        }
    }

    public function deleteUser(Request $request , $user_id){
        $user = User::find($user_id);
        if ($user){
            $delete = $user->delete();
            return redirect('dashboard')->with('success','Ο χρήστης Διαγράφτηκε');
        }
    }
}
