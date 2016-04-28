<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Teacher;
use App\Http\Requests\TeacherUpdateRequest;
use App\Http\Requests;
use App\News;
use App\Notice;
use App\User;
use DB;

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
        $teacher = Auth::guard('teacher')->user();
        $teacher['guard'] = 'teacher';

        return view('teacher.me.index', compact('teacher'));
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

    public function user($id)
    {
        $user = User::find($id);

        return view('teacher.info.user', compact('user'));
    }

    public function showCheck()
    {
        $teacher = Auth::guard('teacher')->user();
        $topics = $teacher->topics;

        foreach ($topics as $topic) {

            $check = DB::table('topic_check')->where('topic_id', $topic->id)->first();
            $topic['check'] = $check;

            foreach ($topic->users as $user) {
                if ($user->pivot->active) {
                    $topic['user_name'] = $user->name;
                    $topic['user_id'] = $user->id;
                }
            }
        }

        return view('teacher.check', compact('topics'));
    }

    public function storeCheck(Request $request, $id)
    {
        $result = DB::table('topic_check')->where('topic_id', $id)->get();
        $check = $request->has('check') ? true : '';

        if ($result) {
            DB::table('topic_check')->where('topic_id', $id)->update([
                'report_status' => $request->input('report'),
                'topic_status' => $request->input('topic'),
                'teach_status' => $request->input('teach'),
                'total' => $request->input('total'),
                'advice' => $request->input('advice'),
                'active' => $check,
            ]);
        } else {
            DB::table('topic_check')->insert([
                'topic_id' => $id,
                'report_status' => $request->input('report'),
                'topic_status' => $request->input('topic'),
                'teach_status' => $request->input('teach'),
                'total' => $request->input('total'),
                'advice' => $request->input('advice'),
                'active' => $check,
            ]);
        }

        return redirect()->back()->withSuccess("success");
    }

}
