<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserUpdateRequest;
use Auth;
use App\Http\Requests;
use App\Notice;
use App\News;
use App\Teacher;
use DB;

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

        return redirect("/user/$id/edit")->withSuccess('成功');
    }

    public function enter()
    {
        return redirect('/user/home');
    }

    public function information()
    {
        $news = News::paginate(3);
        $notices = Notice::paginate(3);

        return view('home', compact('news', 'notices'));
    }

    public function teacher($id)
    {
        $teacher = Teacher::find($id);

        return view('auth.info.teacher', compact('teacher'));
    }

    public function showCheck()
    {
        $user = Auth::user();

        foreach ($user->topics as $topic) {
            if ($topic->pivot->active == true) {
                $id = $topic->id;
                $name = $topic->name;
                break;
            }
        }

        $result = DB::table('topic_check')->where('topic_id', $id)->first();
        $result->name = $name;

        switch ($result->report_status) {
            case 1:
                $result->report_status = '一般';
                break;
            case 0:
                $result->report_status = '差';
                break;
            default:
                $result->report_status = '好';
        }

        switch ($result->topic_status) {
            case 1:
                $result->topic_status = '初稿';
                break;
            case 0:
                $result->topic_status = '未开始';
                break;
            default:
                $result->topic_status = '基本完成';
        }

        switch ($result->teach_status) {
            case 1:
                $result->teach_status = '一般';
                break;
            case 0:
                $result->teach_status = '差';
                break;
            default:
                $result->teach_status = '好';
        }

        switch ($result->total) {
            case 1:
                $result->total = '一般';
                break;
            case 0:
                $result->total = '差';
                break;
            default:
                $result->total = '好';
        }

        return view('auth.check', compact('result'));
    }

    public function showDefense()
    {
        $user = Auth::user();
        $topics = $user->topics;

        foreach ($topics as $key => $topic) {
            if ($topic->pivot->active == true) {
                $defense = $topic->defense;
                $topic->defense_time = $defense->time;
                $topic->defense_place = $defense->place;
                $topic->defense_status = $topic->status;
                $topic->defense_score = $topic->score;
            } else {
                unset($topics[$key]);
            }
        }

        return view('auth.defense.show', compact('topics'));
    }
}
