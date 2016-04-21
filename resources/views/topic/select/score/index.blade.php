@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>成绩评定</h3>
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
                    <th>学生</th>
                    <th>成绩</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="table-body">
                @foreach ($topics as $topic)
                    <tr>
                        <td><a href="{{ url("topic/$topic->id") }}">{{ $topic->name }}</td>
                        <td><a href="{{ url("/teacher/user/$topic->user_id") }}">{{ $topic->user_name }}</td>
                        <td>{{ $topic->score }}</td>
                        <td>
                            @if ($topic->active)
                                <button class="btn btn-primary btn-md" data-toggle="modal"
                                        data-target="#{{ $topic->id }}">
                                    成绩评定
                                </button>
                            @else
                                <button class="btn btn-primary btn-md" data-toggle="modal"
                                        disabled="disabled" data-target="#{{ $topic->id }}">
                                    成绩评定
                                </button>
                            @endif
                            <div class="modal fade" id="{{ $topic->id }}" data-id="{{ $topic->id }}" tabindex="-1"
                                 role="dialog"
                                 aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close"
                                                    data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">
                                                成绩确认
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" method="POST" action="{{ url('teacher/topic/score') }}"
                                                  class="form-horizontal">
                                                <input type="hidden" name="id" value="{{ $topic->id }}">
                                                <input type="hidden" name="user_id" value="{{ $topic->user_id }}">
                                                {!! csrf_field() !!}
                                                <div class="form-group">
                                                    <label for="score" class="col-sm-2 control-label">
                                                        成绩分数
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="col-sm-6 form-control" id="score"
                                                               name="score" value="{{ $topic->score }}">
                                                    </div>
                                                    <button type="submit" class="col-sm-2 btn btn-primary">
                                                        <i class="fa fa-check"></i>
                                                        确认
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">取消
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

