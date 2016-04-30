@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="text-center">我的答辩</h1>
        </div>
        <hr/>

        <div class="row">
            <div class="col-sm-12">

                @include('layouts.partials.errors')
                @include('layouts.partials.success')

                <table id="tags-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>课题</th>
                        <th>时间</th>
                        <th>地点</th>
                        <th>状态</th>
                        <th>成绩</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($topics as $topic)
                        <tr>
                            <td>{{ $topic->name }}</td>
                            <td>{{ $topic->defense_time }}</td>
                            <td>{{ $topic->defense_place }}</td>
                            <td>
                                @if ($topic->status == 0)
                                    未开始
                                @elseif ($topic->status == 1)
                                    二次答辩
                                @else
                                    已通过
                                @endif
                            </td>
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
    </div>
@stop