<?php

namespace App\Http\Controllers\Topic;

use Illuminate\Http\Request;
use App\Topic;
use App\User;
use App\Teacher;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class TopicSelectController extends Controller
{
    public function index()
    {
        $topics = Topic::all();
        foreach ($topics as $topic) {
            $topic['teacher_name'] = Teacher::where('id', $topic->teacher_id)->first()->name;
            $datas[] = $topic;
        }

        return view('topic.select.index', ['datas' => $datas]);
    }

    public function show()
    {
        $user = Auth::user();
        $datas = [];
        foreach ($user->topics as $topic) {
            $topic['teacher_name'] = Teacher::where('id', $topic->teacher_id)->first()->name;
            $datas[] = $topic;
        }
        
        return view('topic.select.show')->withdatas($datas);
    }

    public function bread(Request $request)
    {
        $college = $request->input('college');
        $grade = $request->input('grade');
        $topics = Topic::where('college', $college)->where('grade', $grade)->get();

        return view('topic.select.index', ['datas' => $topics]);
    }

    public function confirm(Request $request)
    {
        $topicId = $request->get('id');
        $user = Auth::user();
        if ($user->topics()->where('topic_id', $topicId)->first() != null) {
            return back()->withErrors('Exist');
        }

        if ($user->topics()->get()->count() >= 3) {
            return back()->withErrors('Max');
        }

        $user->topics()->attach($topicId);

        return redirect('user/topic/select')->withSuccess('Choose success');
    }

    public function delete(Request $request)
    {
        $topicId = $request->get('id');
        $user = Auth::user();
        $user->topics()->detach($topicId);

        return redirect('/user/topic/show')->withSuccess('success');
    }
}
