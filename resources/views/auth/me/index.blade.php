@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
                <h1 class="text-center">个人资料</h1>
        </div>

        <hr/>

        <div class="row text-center">
            <div class="col-md-6">
                <p>学号: {{ $user->id }}</p>
            </div>
            <div class="col-md-6">
                <p>姓名: {{ $user->name }}</p>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-md-6">
                <p class="text-left">性别: {{ $user->sex }}</p>
            </div>
            <div class="col-md-6">
                <p class="text-left">性别: {{ $user->profile }}</p>
            </div>
        </div>

        <div class="row">
        <div class="col-md-6 text-right">
            <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-success btn-md">
                <i class="fa fa-plus-circle"></i> Edit
            </a>
        </div>
        </div>
    </div>
@endsection