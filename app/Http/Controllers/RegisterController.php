<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Mail;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes = $this->validateRegister();

        $attributes['token'] = Str::random(124);

        $user = User::create($attributes);

        Mail::send('email.emailVerificationEmail', ['token' => $attributes['token']], function($message) use($attributes){
            $message->to($attributes['email']);
            $message->subject('Verify your account!');
        });

        // log the user in
        auth()->login($user);

        return redirect("/")->with("success", "Your account has been created, please verify your email!");
    }

    public function update($token)
    {
        $verifyUser = User::where('token', $token)->first();
  
        $type="fail";
        $message = 'Sorry your email cannot be identified.';

        if(!is_null($verifyUser) ){
            $user = $verifyUser;

            if(!$user->email_verified_at) {
                $user->email_verified_at = now();
                $user->save();
                $type="success";
                $message = "Your email has been verified!";
            } else {
                $message = "Your email was already verified!";
            }
        }
  
      return redirect("/")->with($type, $message);
    }

    protected function validateRegister(?User $user = null): array
    {
        $user ??= new User(); // if null just use blank template

        return request()->validate([
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'forename' => ['required', 'min:2', 'max:20'],
            'surname' => ['required', 'min:2', 'max:20'],
            'password' => ['required', 'min:6', 'max:255', 'confirmed']
        ]);
    }
}
