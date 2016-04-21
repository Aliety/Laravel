@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="text-center">学生资料</h1>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6 text-center">
                <p>学号: {{ $user->id }}</p>
                <p>姓名: {{ $user->name }}</p>
                <p>邮箱: {{ $user->email }}</p>
                <p>生日: {{ $user->birthday }}</p>
            </div>

            <div class="col-md-6 text-center">
                <p>性别: {{ $user->sex }}</p>
                <p>年级: {{ $user->grade }}</p>
                <p>学院: {{ $user->college }}</p>
                <p>电话: {{ $user->tel }}</p>
            </div>
        </div>
    </div>
@endsection