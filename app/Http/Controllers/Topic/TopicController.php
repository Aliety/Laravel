<?php

namespace App\Http\Controllers\Topic;

use Illuminate\Http\Request;
use App\Teacher;
use App\Topic;
use App\User;
use App\Http\Requests;
use App\Http\Requests\TopicCreateRequest;
use App\Http\Requests\TopicUpdateRequest;
use App\Http\Controllers\Controller;
use Auth;
use App\Jobs\TopicFormFields;

class TopicController extends Controller
{
    public function index()
    {
        $user = Auth::guard('teacher')->user();
        $topics = Teacher::find($user->id)->topics;

        return view('topic.index', compact('topics'));
    }

    public function show($id)
    {
        $topic = Topic::find($id);
        $topic['teacher'] = Teacher::find($topic->teacher_id)->name;
        return view('topic.show', $topic);
    }

    public function create()
    {
        $data = $this->dispatch(new TopicFormFields());

        return view('topic.create', $data);
    }

    public function store(TopicCreateRequest $request)
    {
        $teacher = Teacher::find(Auth::guard('teacher')->user()->id);

        $topic = $teacher->topics()->create($request->topicFillData());

        return redirect()->route('topic.index')->withSuccess('Create');
    }

    public function edit($id)
    {
        $data = $this->dispatch(new TopicFormFields($id));

        return view('topic.edit', $data);
    }

    public function update(TopicUpdateRequest $request, $id)
    {
        $topic = Topic::find($id);
        $topic->fill($request->topicFillData());
        $topic->save();

        return redirect()->route('topic.index')->withSuccess('Topic saved');
    }

    public function state($id)
    {
        $topic = Topic::find($id);
        $users = $topic->users()->get();
        $count = $topic->users()->where('active', 1)->count();

        return view('topic.state', compact('topic', 'users', 'count'));
    }

    public function active($topic_id, $user_id)
    {
        $user = User::find($user_id);

        foreach ($user->topics as $topic) {
            if ($topic->pivot->topic_id == $topic_id) {
                $user->topics()->attach($topic_id, ['active' => 1]);
            }
        }

        return back()->withSuccess('success');
    }

    public function showScore()
    {
        $teacher = Auth::guard('teacher')->user();
        $topics = $teacher->topics;
        foreach ($topics as $topic) {
            foreach ($topic->users as $user) {
                if ($user->pivot->active) {
                    $topic['user_name'] = $user->name;
                    $topic['user_id'] = $user->id;
                    $topic['score'] = $user->pivot->score;
                }
            }
        }

        return view('topic.select.score.index')->with('topics', $topics);
    }

    public function confirmScore(Request $request)
    {
        $id = $request->input('id');
        $userId = $request->input('user_id');
        $topic = Topic::find($id);
        foreach ($topic->users as $user) {
            if ($user->id == $userId && $user->pivot->active == true) {
                $user->pivot->score = $request->input('score');
                $user->pivot->save();
            }
        }

        return redirect()->back()->withSuccess('Success');
    }
}
