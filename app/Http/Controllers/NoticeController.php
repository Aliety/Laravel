<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Notice;
use App\Http\Requests\NoticeCreateRequest;
use App\Http\Requests\NoticeUpdateRequest;

class NoticeController extends Controller
{
    protected $fields = [
        'title' => '',
        'content' => '',
    ];

    public function index()
    {
        $notices = Notice::all();

        return view('admin.notice.index')->withNotices($notices);
    }

    public function create()
    {
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }

        return view('admin.notice.create', $data);
    }

    public function store(NoticeCreateRequest $request)
    {
        $notice = new Notice();
        foreach (array_keys($this->fields) as $field) {
            $notice->$field = $request->get($field);
        }
        $notice->save();

        return redirect('/admin/notice');
    }

    public function edit($id)
    {
        $notice = Notice::findOrFail($id);
        $data = ['id' => $id];
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $notice->$field);
        }

        return view('admin.notice.edit', $data);
    }

    public function update(NoticeUpdateRequest $request, $id)
    {
        $notice = Notice::findOrFail($id);
        foreach (array_keys($this->fields) as $field) {
            $notice->$field = $request->get($field);
        }
        $notice->save();

        return redirect("/admin/notice/$id/edit")->withSuccess("save");
    }

    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);
        $notice->delete();

        return redirect('/admin/notice')->withSuccess('deleted');
    }
}
