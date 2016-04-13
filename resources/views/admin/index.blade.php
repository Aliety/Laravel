@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="text-center">管理员模式</h1>
        </div>
        <hr/>
        <div class="row text-center">
            <div class="col-md-4">
                <a href="/admin/user" type="button" class="btn btn-primary btn-lg">
                    学生管理
                </a>
            </div>
            <div class="col-md-4">
                <a href="/admin/teacher" type="button" class="btn btn-primary btn-lg">
                    教师管理
                </a>
            </div>
            <div class="col-md-4">
                <a href="/admin/upload" type="button" class="btn btn-primary btn-lg">
                    文件管理
                </a>
            </div>
        </div>
        <br/>
        <div class="row text-center">
            <div class="col-md-4">
                <a href="/admin/topic" type="button" class="btn btn-primary btn-lg">
                    课题管理
                </a>
            </div>
            <div class="col-md-4">
                <a href="/admin/news" type="button" class="btn btn-primary btn-lg">
                    新闻管理
                </a>
            </div>
            <div class="col-md-4">
                <a href="/admin/notice" type="button" class="btn btn-primary btn-lg">
                    通知管理
                </a>
            </div>
        </div>
        <hr/>
    </div>
@endsection