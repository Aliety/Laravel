<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Auth;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['showResetForm', 'reset']]);
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('teacher.passwords.email');
    }

    public function reset(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);
        $password = $request->input('password');
        $teacher = Auth::guard('teacher')->user();
        $teacher->password = bcrypt($password);
        $teacher->save();

        return redirect('/teacher/home')->withSuccess('password updated !');

    }
}
