@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row text-center">
            <h1>个人资料</h1>
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

        <div class="row text-center">
            <div class="col-md-12 ">
                <a href="{{ route('teacher.edit', ['id' => $id]) }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 编辑
                </a>
            </div>
        </div>
    </div>
@endsection