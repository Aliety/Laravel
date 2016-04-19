@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row text-center">
            <h1>个人资料</h1>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6 text-center">
                <p>工号: {{ $teacher->id }}</p>
                <p>姓名: {{ $teacher->name }}</p>
                <p>邮箱: {{ $teacher->email }}</p>
                <p>职称: {{ $teacher->title }}</p>
            </div>

            <div class="col-md-6 text-center">
                <p>专业: {{ $teacher->grade }}</p>
                <p>学院: {{ $teacher->college }}</p>
                <p>电话: {{ $teacher->tel }}</p>
                <p>简介: {{ $teacher->profile }}</p>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-md-12 ">
                <a href="{{ route('teacher.edit', ['id' => $teacher->id]) }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 编辑
                </a>
            </div>
        </div>
    </div>
@endsection