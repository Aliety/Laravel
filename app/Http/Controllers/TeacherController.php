<?php

namespace App\Http\Controllers;

use App\Defense;
use Illuminate\Http\Request;
use Auth;
use App\Teacher;
use App\Http\Requests\TeacherUpdateRequest;
use App\Http\Requests;
use App\News;
use App\Notice;
use App\User;
use DB;
use App\Topic;

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

    public function indexDefense()
    {
        $role = Auth::guard('teacher')->user();
        $defenses = $role->defenses;

        foreach ($defenses as $key => $defense) {
            if ($defense->pivot->role == 0) {
                foreach ($defense->teachers as $teacher) {
                    if ($teacher->pivot->role == 1) {
                        $defense->check_advice = $teacher->pivot->advice;
                        $defense->check_score = $teacher->pivot->score;
                    }
                    if ($teacher->pivot->role == 2) {
                        $defense->group_advice = $teacher->pivot->advice;
                        $defense->group_score = $teacher->pivot->score;
                    }
                }
                $topic = Topic::find($defense->topic_id);
                $defense->topic_name = $topic->name;
                foreach ($topic->users as $user) {
                    if ($user->pivot->active) {
                        $defense->user_name = $user->name;
                    }
                }
            } else {
                unset($defenses[$key]);
            }
        }
        //dd($defenses);
        return view('teacher.defense.index', compact('defenses'));
    }

    public function checkDefense(Request $request, $id)
    {
        $teacherID = Auth::guard('teacher')->user()->id;
        $defense = Defense::find($id);
        $defense->score = $request->input('defense_score');
        $defense->save();

        $defense->teachers()->where('teacher_id', $teacherID)->update([
            'advice' => $request->input('advice'),
            'score' => $request->input('score')
        ]);

        return redirect()->back()->withSuccess('succeed');
    }

    public function showDefense()
    {
        $teacher = Auth::guard('teacher')->user();
        $defenses = $teacher->defenses;

        foreach ($defenses as $key => $defense) {
            if ($defense->pivot->role == 1) {
                foreach ($defense->teachers as $teacher) {
                    if ($teacher->pivot->role == 0) {
                        $defense->teach_advice = $teacher->pivot->advice;
                        $defense->teach_score = $teacher->pivot->score;
                    }
                    if ($teacher->pivot->role == 2) {
                        $defense->group_advice = $teacher->pivot->advice;
                        $defense->group_score = $teacher->pivot->score;
                    }
                }
                $topic = Topic::find($defense->topic_id);
                $defense->topic_name = $topic->name;
                foreach ($topic->users as $user) {
                    if ($user->pivot->active) {
                        $defense->user_name = $user->name;
                    }
                }
            } else {
                unset($defenses[$key]);
            }
        }
        //dd($defenses);
        return view('teacher.defense.show', compact('defenses'));
    }

    public function storeDefense(Request $request, $id)
    {
        $teacherID = Auth::guard('teacher')->user()->id;
        $defense = Defense::find($id);
        $defense->time = $request->input('time');
        $defense->place = $request->input('place');
        $defense->status = $request->input('status');
        $defense->save();

        $defense->teachers()->where('teacher_id', $teacherID)->update([
            'advice' => $request->input('advice'),
            'score' => $request->input('score')
        ]);

        return redirect()->back()->withSuccess('succeed');
    }

    public function groupDefense()
    {
        $teacher = Auth::guard('teacher')->user();
        $defenses = $teacher->defenses;

        foreach ($defenses as $key => $defense) {
            if ($defense->pivot->role == 2) {
                foreach ($defense->teachers as $teacher) {
                    if ($teacher->pivot->role == 0) {
                        $defense->teach_advice = $teacher->pivot->advice;
                        $defense->teach_score = $teacher->pivot->score;
                    }
                    if ($teacher->pivot->role == 1) {
                        $defense->check_advice = $teacher->pivot->advice;
                        $defense->check_score = $teacher->pivot->score;
                    }
                }
                $topic = Topic::find($defense->topic_id);
                $defense->topic_name = $topic->name;
                foreach ($topic->users as $user) {
                    if ($user->pivot->active) {
                        $defense->user_name = $user->name;
                    }
                }
            } else {
                unset($defenses[$key]);
            }
        }
        //dd($defenses);
        return view('teacher.defense.group', compact('defenses'));
    }

    public function storeGroup(Request $request, $id)
    {
        $teacherID = Auth::guard('teacher')->user()->id;
        $defense = Defense::find($id);

        $defense->teachers()->where('teacher_id', $teacherID)->update([
            'advice' => $request->input('advice'),
            'score' => $request->input('score')
        ]);

        return redirect()->back()->withSuccess('succeed');
    }
}
