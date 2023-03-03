<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mail;

class ResetPasswordController extends Controller
{
    public function show()
    {
        return view('login.show');
    }

    public function store()
    {
        //You can add validation login here
        $user = User::where('email', '=', request()->email)->first();
        //Check if the user exists
        if (is_null($user)) {
            return redirect("/login")->with('fail', 'An error occured');
        }
        $resetPW = DB::table('password_reset_tokens')->where('email', request()->email)->first();
        if (!is_null($resetPW)) {
            return redirect("/login")->with('fail', 'An email has already been sent!');
        }

        //Create Password Reset Token
        DB::table('password_reset_tokens')->insert([
            'email' => request()->email,
            'token' => Str::random(124),
            'created_at' => now()
        ]);
        //Get the token just created above
        $tokenData = DB::table('password_reset_tokens')->where('email', request()->email)->first();
        
        if ($this->sendResetEmail(request()->email, $tokenData->token)) {
            return redirect('/')->with('success', 'A reset link has been sent to your email address.');
        } else {
            return redirect('/')->with('fail', 'An error occured');
        }
    }

    public function edit($token, $email)
    {
        return view('login.edit', [
            'email' => $email,
            'token' => $token
        ]);
    }

    public function update()
    {
        $attributes = $this->validateResetPassword();

        $tokenData = DB::table('password_reset_tokens')->where('token', $attributes['token'])->first();
        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return back();
        
        $user = User::where('email', $attributes['email'])->first();
        // Redirect the user back if the email is invalid
        if (!$user) return back();
        //Hash and update the new password

        $user->password = $attributes['password'];
        $user->update(); //or $user->save();
        
            //login the user immediately they change password successfully
        auth()->login($user);
        
        DB::table('password_reset_tokens')->where('email', $attributes['email'])->delete();
        
        return redirect("/")->with('success', 'Your password has been updated!');

    }

    private function sendResetEmail($email, $token)
    {
        Mail::send('email.emailResetPassword', ['email' => $email, 'token' => $token], function($message) use($email) {
            $message->to($email);
            $message->subject('Reset your password!');
        });

        return true;
    }

    protected function validateResetPassword(): array
    {
        return request()->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed'],
            'token' => ['required']
        ]);
    }
}
