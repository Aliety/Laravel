<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\News;
use App\Notice;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::paginate(3);
        $notices = Notice::paginate(3);

        return view('home', compact('news', 'notices'));
    }

    public function news()
    {
        $news = News::where('created_at', '<=', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.news.index', compact('news'));
    }
}
