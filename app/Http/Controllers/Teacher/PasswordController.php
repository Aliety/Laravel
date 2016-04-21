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

    protected $guard = 'teacher';
    protected $broker = 'teachers';
    protected $resetView = 'teacher.passwords.reset';
    protected $redirectPath = '/teacher/home';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'showResetForm']);
    }

    public function getEmail()
    {
        return view('teacher.passwords.email');
    }

    public function showForm()
    {
        return view('teacher.passwords.new');
    }

    public function newReset(Request $request)
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
