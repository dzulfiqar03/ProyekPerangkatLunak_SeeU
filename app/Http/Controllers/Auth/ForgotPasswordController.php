<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    function forgotPassword()
    {
        return view("auth.password.forgot-password");
    }

    function forgotPasswordPost(Request $request)
    {
        $request->validate([
            'email' => "required|email|exists:users",
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send("auth.emails.forgot-password", ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Reset Password");
        });
        return redirect()->to(route("forgot.password"))->with("success", "We send email to reset password");
    }


    function resetPassword($token)
    {
        return view("auth.password.new-password", compact('token'));
    }

    function resetPasswordPost(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:users",
            "password" => "required|string|min:8|confirmed",
            "password_confirmation" => "required"
        ]);

        $updatePassword = DB::table('password_resets')->where([
            "email" => $request->email,
            "token" => $request->token
        ])->first();

        if (!$updatePassword) {
            return redirect()->to(route("reset.password"))->with("error", "invalid");
        }
        User::where("email", $request->email)->update(["password" => Hash::make($request->password)]);

        DB::table("password_resets")->where(["email" => $request->email])->delete();

        return redirect()->to(route("login"))->with("success", "Password Reset Successfull");
    }


}