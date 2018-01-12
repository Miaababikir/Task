<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CheckStatus');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function resetPassword()
    {
        return view('resetPassword');
    }

    public function resetting(Request $request)
    {
        // Validating the data in the request
        $this->validate($request,[
            'oldPassword'   => 'required',
            'password'      => 'required',
        ]);

        // Get the currently authenticated user's ID...
        $id = Auth::id();

        // Getting user with that id
        $user = User::findOrFail($id);

        // Checking the user old password with the password that he enter
        if (Hash::check($request->oldPassword, $user->password))
        {
            $user->password = bcrypt($request->password);

            $user->save();

            Session::flash('success', 'The password is updated');

            return redirect(route('home'));
        }
        else
        {
            Session::flash('error', 'Enter password again!');

            return redirect(route('home.password'));
        }

//        dump($hashedPassword);
//        dump($user->password);
    }


}
