<?php

namespace App\Http\Controllers\Admin;

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

    protected $guard = 'admin';
    protected $broker = 'admins';
    protected $resetView = 'admin.passwords.reset';
    protected $redirectPath = '/admin';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'showResetForm']);
    }

    public function getEmail()
    {
        return view('admin.passwords.email');
    }
}
