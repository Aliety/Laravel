<?php

namespace App\Http\Controllers\Teacher;

use App\Teacher;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/teacher';
    protected $guard = 'teacher';
    protected $loginView = 'teacher.login';
    protected $username = 'id';

    public function __construct()
    {
        $this->middleware('guest:teacher', ['except' => 'logout']);
    }

    public function getRedirectTo()
    {
        return $this->redirectTo;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'id' => 'required|max:255|unique:teachers',
            'password' => 'required|min:6',
        ]);
    }

    protected function create(array $data)
    {
        return Teacher::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

    }

}
