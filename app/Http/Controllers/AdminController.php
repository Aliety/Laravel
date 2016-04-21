<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\User;
use App\Teacher;
use App\Topic;

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
        $user->email = $request->input('id') . '@hqu.edu.cn';
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
        $teacher->email = $request->input('id') . '@hqu.edu.cn';
        $teacher->password = bcrypt($request->input('id'));
        $teacher->save();

        return redirect('/admin/teacher');
    }

    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        if (!empty($user->thesis()->first())) {
            return redirect()->back()->withErrors("thesis exist");
        }

        if (!empty($user->topics()->first())) {
            return redirect()->back()->withErrors("topic exist");
        }

        $user->delete();

        return redirect('/admin/user')->withSuccess("deleted");
    }

    public function teacherDelete($id)
    {
        $teacher = Teacher::findOrFail($id);
        if (!empty($teacher->theses()->first())) {
            return redirect()->back()->withErrors("thesis exist");
        }

        if (!empty($teacher->topics()->first())) {
            return redirect()->back()->withErrors("topic exist");
        }

        $teacher->delete();

        return redirect('/admin/teacher')->withSuccess("deleted");
    }

    public function topicIndex()
    {
        $topics = Topic::all();
        foreach ($topics as $topic) {
            if ($topic->users()->first()) {
                $topic['check_active'] = true;
            }
        }

        return view('admin.topic.show')->withTopics($topics);
    }

    public function topicShow($id)
    {
        $topic = Topic::find($id);
        $users = $topic->users;
        foreach ($users as $user) {
            $user['topic_name'] = $topic->name;
            $user['topic_id'] = $topic->id;
        }

        return view('admin.topic.index')->withUsers($users);
    }

    public function topicCheck($id)
    {
        $topic = Topic::find($id);
        $topic->active = true;
        $topic->save();

        return redirect()->back()->withSuccess("checked");
    }
    public function topicDelete($id)
    {
        $topic = Topic::find($id);
        $topic->delete();

        return redirect("/admin/topic")->withSuccess("deleted");
    }

    public function selectDelete(Request $request)
    {
        $user = User::find($request->input('user_id'));
        $user->topics()->detach($request->input('topic_id'));

        return redirect()->back()->withSuccess('deleted');
    }

    public function user($id)
    {
        $user = User::find($id);

        return view('admin.info.user', compact('user'));
    }

    public function teacher($id)
    {
        $teacher = Teacher::find($id);

        return view('admin.info.teacher', compact('teacher'));
    }
}
