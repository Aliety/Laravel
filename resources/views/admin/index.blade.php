@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="text-center">管理员模式</h1>
        </div>
        <hr/>
        <div class="row col-md-4 text-center">
            <a href="/admin/user" type="button" class="btn btn-primary btn-lg">
                学生管理
            </a>
        </div><div class="row col-md-4 text-center">
            <a href="/admin/teacher" type="button" class="btn btn-primary btn-lg">
                教师管理
            </a>
        </div>
        <div class="row col-md-4 text-center">
            <a href="/admin/upload" type="button" class="btn btn-primary btn-lg">
                文件管理
            </a>
        </div>
        <div class="row col-md-4 text-center">
            <button type="button" class="btn btn-primary btn-lg">
                信息管理
            </button>
        </div>
        <hr/>
    </div>
@endsection