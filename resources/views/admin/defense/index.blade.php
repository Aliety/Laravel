@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="text-center">论文答辩</h1>
        </div>
        <hr/>

        <div class="row">
            <div class="col-sm-12">

                @include('layouts.partials.errors')
                @include('layouts.partials.success')

                <table id="tags-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>课题名称</th>
                        <th>导师</th>
                        <th>答辩学生</th>
                        <th>答辩地点</th>
                        <th>答辩时间</th>
                        <th>答辩成绩</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($topics as $topic)
                        <tr>
                            <td>{{ $topic->name }}</td>
                            <td>{{ $topic->teacher_name }}</td>
                            <td>{{ $topic->user_name }}</td>
                            <td>{{ $topic->defense_place }}</td>
                            <td>{{ $topic->defense_time }}</td>
                            <td>{{ $topic->defense_score }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop