@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-center">课题信息</h1>
        <hr/>
        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <p>课题：{{ $name }}</p>
                <p>学院：{{ $college }}</p>
                <p>指导老师：{{ $teacher }}</p>
                <p>年级：{{ $grade }}</p>
                <p>类型：{{ $type }}</p>
                <p>地点：{{ $place }}</p>
            </div>
            <div class="col-md-4 col-md-offset-2">
                <p>时间：{{ $week }}周</p>
                <p>人数：{{ $number }}</p>
                <p>难易程度：{{ $level }}</p>
                <p>要求：{{ $requirement }}</p>
                <p>内容：{{ $content }}</p>
                <p>简介：{{ $profile }}</p>
            </div>
        </div>
    </div>
@endsection