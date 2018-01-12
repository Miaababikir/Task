<?php

namespace App\Http\Controllers\Auth;

use App\Mail\thankingEmail;
use App\Mail\wellcomeEmail;
use App\User;
use App\Mail\verifyEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
Use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => [
            'sendEmailDone',
        ]]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verifyToken' => Str::random(20),
            'status' => '0',
        ]);

        // Getting user by id
        $thisUser = User::findOrFail($user->id);
        // To send email for the specific user
        $this->sendEmail($thisUser);

        return $user;
    }

    public function sendEmail($thisUser)
    {
        // This is for welcome message
        Mail::to($thisUser->email)->send(new wellcomeEmail($thisUser));
        // This is for confirmation message
        Mail::to($thisUser->email)->send(new verifyEmail($thisUser));
    }

    public function sendEmailDone($email, $verifyToken)
    {
        // Getting user that we need to confirm his account
        $user = User::where(['email' => $email, 'verifyToken' => $verifyToken])->first();

        // Checking if there user with this email and token
        if ($user)
        {
            // Update user data after confirmation
            User::where(['email' => $email, 'verifyToken' => $verifyToken])->update(['status' => '1', 'verifyToken' => null]);
            // Sending thanking message
            Mail::to($user->email)->send(new thankingEmail($user));
            // Redirect to homepage
            return redirect()->route('home');
        }
        else
        {
            return "Not found";
        }
    }
}
