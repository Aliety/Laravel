@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="text-center">个人资料</h1>
        </div>

        <hr/>

        <div class="row text-center">
            <div class="col-md-6">
                <p>工号: {{ $id }}</p>
            </div>
            <div class="col-md-6">
                <p>姓名: {{ $name }}</p>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-md-6">
                <p>学院: {{ $college }}</p>
            </div>
            <div class="col-md-6">
                <p>专业: {{ $major }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 text-center">
                <a href="{{ route('teacher.edit', ['id' => $id]) }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> Edit
                </a>
            </div>
        </div>
    </div>
@endsection