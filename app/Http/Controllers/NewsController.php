<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\News;

class NewsController extends Controller
{
    public function index() {
        $news = News::all()->orderBy('created_at', 'desc');

        return view('news.index', compact('news'));
    }

    public function create() {
        return view('news.create');
    }

    public function store(Request $request) {
        $news = new News();
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->save();

        return redirect('/news')->withSuccess("success");
    }
}
