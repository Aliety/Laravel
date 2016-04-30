@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>毕设成绩</h3>
            </div>
        </div>

        @include('layouts.partials.errors')
        @include('layouts.partials.success')
        @include('layouts.partials.msg')

    </div>

    <div class="row">
        <div class="col-sm-12">
            <table id="topics" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>课题</th>
                    <th>导师</th>
                    <th>成绩</th>
                </tr>
                </thead>
                <tbody id="table-body">
                @foreach ($topics as $topic)
                    <tr>
                        <td><a href="{{ url("topic/$topic->id") }}">{{ $topic->name }}</td>
                        <td><a href="{{ url("/user/teacher/$topic->teacher_id") }}">{{ $topic->teacher_name }}</td>
                        <td>
                            @if ($topic->score == 5)
                                优秀
                            @elseif ($topic->score == 4)
                                良好
                            @elseif ($topic->score == 3)
                                中等
                            @elseif ($topic->score == 2)
                                及格
                            @elseif ($topic->score ==1)
                                不及格
                            @else
                                暂无
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

