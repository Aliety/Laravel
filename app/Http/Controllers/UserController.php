<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserUpdateRequest;
use Auth;
use App\Http\Requests;

class UserController extends Controller
{
    protected $fields = [
        'name' => '',
        'sex' => '',
        'birthday' => '',
        'grade' => '',
        'college' => '',
        'major' => '',
        'tel' => '',
        'profile' => ''
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        return view('auth.me.index', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('auth.me.edit', $user);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);
        foreach (array_keys($this->fields) as $field) {
            $user->$field = $request->get($field);
        }
        $user->save();

        return redirect("/user/$id/edit")->withSuccess("Changes saved");
    }
}