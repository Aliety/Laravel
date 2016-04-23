<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Carbon\Carbon;
use Auth;
use App\Message;
use DB;
use App\Http\Requests\CreateMessageRequest;

class MessageController extends Controller
{
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        $userID = isset($request->user()->id) ? $request->user()->id : $request->user('teacher')->id;

        $messages = DB::table('message_link')->where('rec_id', $userID)->get();

        foreach ($messages as $message) {
            $data = Message::find($message->id);
            $message->title = $data->title;
            $message->content = $data->content;
        }

        return view('message.index', compact('messages'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('messages');
        }
        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();
        // don't show the current user in list
        $userId = Auth::user()->id;
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();
        $thread->markAsRead($userId);

        return view('messenger.show', compact('thread', 'users'));
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        return view('message.create');
    }

    public function sent(Request $request)
    {
        $userID = isset($request->user()->id) ? $request->user()->id : $request->user('teacher')->id;
        $messages = DB::table('message_link')->where('send_id', $userID)->get();

        foreach ($messages as $message) {
            $data = Message::find($message->id);
            $message->title = $data->title;
            $message->content = $data->content;
            $message->message_status = $data->status;
        }

        return view('message.sent', compact('messages'));
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */

    public function store(CreateMessageRequest $request)
    {
        $userID = isset($request->user()->id) ? $request->user()->id : $request->user('teacher')->id;
        $message = Message::create(
            [
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'created_at' => Carbon::now(),
                'status' => 0,
            ]
        );

        $messageLink = DB::table('message_link')->insert(
            [
                'send_id' => $userID,
                'rec_id' => $request->input('rec_id'),
                'message_id' => $message->id,
                'created_at' => Carbon::now(),
                'status' => 0,
            ]
        );

        return redirect('/message/sent')->withSuccess('sent!');
    }

    public function ajax(Request $request)
    {
        $id = $request->input('message_id');
        if ($request->ajax()) {
            $messages = DB::table('message_link')->where('id', $id)->get();
            return response()->json(['name' => $id, 'state' => '已读']);
        } else
            return response()->json(['msg' => 'false']);
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */

    public function destroy($id)
    {
        $message = Message::find($id);
        $message->status = 1;
        $message->save();

        return redirect()->back()->withSuccess("deleted");
    }

}
