<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Teacher;
use App\Http\Requests\TeacherUpdateRequest;
use App\Http\Requests;
use App\News;
use App\Notice;

class TeacherController extends Controller
{
    protected $fields = [
        'name' => '',
        'college' => '',
        'major' => '',
        'title' => '',
        'tel' => '',
        'profile' => ''
    ];

    public function __construct()
    {
        $this->middleware('auth:teacher');
    }

    public function index()
    {
        $admin = Auth::guard('teacher')->user();
        $admin['guard'] = 'teacher';

        return view('teacher.me.index', $admin);
    }

    public function edit($id)
    {
        $teacher = Teacher::find($id);

        return view('teacher.me.edit', $teacher);
    }

    public function update(TeacherUpdateRequest $request, $id)
    {
        $teacher = Teacher::find($id);
        foreach (array_keys($this->fields) as $field) {
            $teacher->$field = $request->get($field);
        }
        $teacher->save();

        return redirect("/teacher/$id/edit")->withSuccess("成功");
    }

    public function enter()
    {
        return redirect('/teacher/home');
    }

    public function information()
    {
        $news = News::paginate(3);
        $notices = Notice::paginate(3);

        return view('home', compact('news', 'notices'));
    }
}
