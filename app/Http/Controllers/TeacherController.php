<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Teacher;
use App\Http\Requests\TeacherUpdateRequest;
use App\Http\Requests;

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

        return redirect("/teacher")->withSuccess("Changed saved");
    }

    public function enter()
    {
        return redirect('/teacher');
    }
}
