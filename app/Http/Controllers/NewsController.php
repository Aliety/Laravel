<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\News;
use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsUpdateRequest;

class NewsController extends Controller
{
    protected $fields = [
        'title' => '',
        'content' => '',
    ];

    public function index() {
        $news = News::where('created_at', '<=', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.news.index', compact('news'));
    }

    public function create() {
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }

        return view('admin.news.create', $data);
    }

    public function store(NewsCreateRequest $request) {
        $news = new News();
        foreach (array_keys($this->fields) as $field) {
            $news->$field = $request->get($field);
        }
        $news->save();

        return redirect('admin/news')->withSuccess("success");
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $data = ['id' => $id];
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $news->$field);
        }

        return view('admin.news.edit', $data);
    }

    public function update(NewsUpdateRequest $request, $id)
    {
        $news = News::findOrFail($id);
        foreach (array_keys($this->fields) as $field) {
            $news->$field = $request->get($field);
        }
        $news->save();

        return redirect("/admin/news/$id/edit")->withSuccess("saved");
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect('admin/news')->withSuccess('deleted');
    }
}
