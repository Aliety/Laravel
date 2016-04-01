<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;
use Auth;
use App\Topic;

class TaskController extends Controller
{
    public function index()
    {
        $teacher = Auth::guard('teacher')->user();
        $topics = $teacher->topics;
        foreach ($topics as $key => $topic) {
            $users = $topic->users;
            foreach ($users as $user) {
                if ($user->pivot->active) {
                    $topic['user_name'] = $user->name;
                }
            }
            if (empty($topic['user_name'])) {
                unset($topics[$key]);
            }
        }

        return view('task.index')->with('topics', $topics);
    }

    public function show($id)
    {
        $topic = Topic::find($id);
        $tasks = $topic->tasks;

        return view('task.show')->with('tasks', $tasks);

    }

    public function create(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
        ]);

        $task = new Task(['content' => $request->input('content')]);
        $topic = Topic::find($request->input('topic_id'));

        $topic->tasks()->save($task);

        return redirect()->back()->withSuccess('Success');
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect()->back()->withSuccess('Success');
    }

    public function showTask()
    {
        $user = Auth::user();
        foreach ($user->topics as $topic) {
            if ($topic->pivot->active) {
                $id = $topic->id;
                break;
            }
        }

        if ($id) {
            $topic = Topic::find($id);
            $tasks = $topic->tasks;
            return view('task.user')->with('tasks', $tasks);
        }

        return redirect()->back()->withMsg('not exist');
    }
}
