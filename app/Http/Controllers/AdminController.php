<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\User;
use App\Teacher;
use App\Topic;
use App\Defense;

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

    public function showDefense()
    {
        $topics = Topic::all();

        foreach ($topics as $topic) {
            $topic->teacher_name = Teacher::find($topic->teacher_id)->name;
            if ($topic->defense) {
                $topic->defense_time = $topic->defense->time;
                $topic->defense_place = $topic->defense->place;
                $topic->defense_score = $topic->defense->score;
            }
            foreach($topic->users as $user)
                if ($user->pivot->active) {
                    $topic->user_name = $user->name;
                }
        }

        $topic_count = $topics->count();
        $teacher_count = Teacher::all()->count();

        return view('admin.defense.index', compact('topics', 'topic_count', 'teacher_count'));

    }

    public function defenseCheck()
    {
        $defenses = Defense::all();
        foreach ($defenses as $defense) {
            $topic = $defense->topic;
            $defense->topic_name = $topic->name;
            $defense->teacher_name = Teacher::find($topic->teacher_id)->name;
            foreach ($topic->users as $user) {
                if ($user->pivot->active) {
                    $defense->user_name = $user->name;
                }
            }
            foreach ($defense->teachers as $teacher) {
                if ($teacher->pivot->role == 1) {
                    $defense->check_name = $teacher->name;
                }
            }
        }

        return view('admin.defense.check', compact('defenses'));
    }

    public function createCheck()
    {
        $teachers = Teacher::all();

        foreach ($teachers as $key => $teacher) {
            if ($teacher->defenses == null) {
                continue;
            } else {
                foreach ($teacher->defenses as $defense) {
                    if ($defense->pivot->role == 1 || $defense->pivot->role == 2) {
                        unset($teachers[$key]);
                    }
                }
            }
        }

        return view('admin.defense.create', compact('teachers'));
    }

    public function storeCheck(Request $request, $id)
    {
        $role = Teacher::find($id);
        $defenses = Defense::all();

        foreach ($defenses as $key => $defense) {
            foreach ($defense->teachers as $teacher) {
                if ($teacher->id == $id) {
                    unset($defenses[$key]);
                }
            }
        }

        $defenses = $defenses->take($request->input('num'));
        //dd($defenses);

        foreach ($defenses as $defense) {
            $defense->teachers()->save($role, ['role' => 1]);
        };

        return redirect()->back()->withSuccess("success");
    }

    public function defenseGroup()
    {
        $defenses = Defense::all();
        foreach ($defenses as $defense) {
            $topic = $defense->topic;
            $defense->topic_name = $topic->name;
            $defense->teacher_name = Teacher::find($topic->teacher_id)->name;
            foreach ($topic->users as $user) {
                if ($user->pivot->active) {
                    $defense->user_name = $user->name;
                }
            }
            foreach ($defense->teachers as $teacher) {
                if ($teacher->pivot->role == 2) {
                    $defense->group_name = $teacher->name;
                }
            }
        }

        return view('admin.defense.group', compact('defenses'));
    }

    public function createGroup()
    {
        $teachers = Teacher::all();

        foreach ($teachers as $key => $teacher) {
            if ($teacher->defenses == null) {
                continue;
            } else {
                foreach ($teacher->defenses as $defense) {
                    if ($defense->pivot->role == 2 || $defense->pivot->role == 1) {
                        unset($teachers[$key]);
                    }
                }
            }
        }

        return view('admin.defense.new', compact('teachers'));
    }

    public function storeGroup(Request $request, $id)
    {
        $role = Teacher::find($id);
        $defenses = Defense::all();

        foreach ($defenses as $key => $defense) {
            foreach ($defense->teachers as $teacher) {
                if ($teacher->id == $id) {
                    unset($defenses[$key]);
                }
            }
        }

        $defenses = $defenses->take($request->input('num'));
        //dd($defenses);

        foreach ($defenses as $defense) {
            $defense->teachers()->save($role, ['role' => 2]);
        };

        return redirect()->back()->withSuccess("success");
    }

}
