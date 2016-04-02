<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\User;
use App\Teacher;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        //$admin = Auth::guard('admin')->user();

        return view('admin.index');
    }

    public function enter()
    {
        return redirect('/admin');
    }

    public function userIndex()
    {
        $users = User::all();

        return view('admin.user.show')->withUsers($users);
    }

    public function teacherIndex()
    {
        $teachers = Teacher::all();

        return view('admin.teacher.show')->withTeachers($teachers);
    }

    public function userAdd(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|unique:users',
        ]);

        $user = new User();
        $user->id = $request->input('id');
        $user->email = $request->input('id').'@hqu.com';
        $user->password = bcrypt($request->input('id'));
        $user->save();

        return redirect('/admin/user');
    }

    public function teacherAdd(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|unique:teachers',
        ]);

        $teacher = new Teacher();
        $teacher->id = $request->input('id');
        $teacher->email = $request->input('id').'@hqu.com';
        $teacher->password = bcrypt($request->input('id'));
        $teacher->save();

        return redirect('/admin/teacher');
    }

    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        if (! empty($user->thesis()->first())) {
            return redirect()->back()->withErrors("thesis exist");
        }

        if (! empty($user->topics()->first())) {
            return redirect()->back()->withErrors("topic exist");
        }

        $user->delete();

        return redirect('/admin/user')->withSuccess("deleted");
    }

    public function teacherDelete($id)
    {
        $teacher = Teacher::findOrFail($id);
        if (! empty($teacher->theses()->first())) {
            return redirect()->back()->withErrors("thesis exist");
        }

        if (! empty($teacher->topics()->first())) {
            return redirect()->back()->withErrors("topic exist");
        }

        $teacher->delete();

        return redirect('/admin/teacher')->withSuccess("deleted");
    }
}
