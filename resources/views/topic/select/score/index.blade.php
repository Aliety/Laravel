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
                                                    <label for="score" class="col-sm-3 control-label">
                                                        等级评定
                                                    </label>
                                                    <div class="col-sm-6">
                                                        @if ($topic->score == 5)
                                                            <select class="form-control" name="score"
                                                                    id="score">
                                                                <option selected="selected" value="5">优秀
                                                                </option>
                                                                <option value="4">良好</option>
                                                                <option value="3">中等</option>
                                                                <option value="2">及格</option>
                                                                <option value="1">不及格</option>
                                                            </select>
                                                        @elseif ($topic->score == 4)
                                                            <select class="form-control" name="score"
                                                                    id="score">
                                                                <option value="5">优秀</option>
                                                                <option selected="selected" value="4">良好
                                                                </option>
                                                                <option value="3">中等</option>
                                                                <option value="2">及格</option>
                                                                <option value="1">不及格</option>
                                                            </select>
                                                        @elseif ($topic->score == 3)
                                                            <select class="form-control" name="score"
                                                                    id="score">
                                                                <option value="5">优秀</option>
                                                                <option value="4">良好</option>
                                                                <option selected="selected" value="3">中等
                                                                </option>
                                                                <option value="2">及格</option>
                                                                <option value="1">不及格</option>
                                                            </select>
                                                        @elseif ($topic->score == 2)
                                                            <select class="form-control" name="score"
                                                                    id="score">
                                                                <option value="5">优秀</option>
                                                                <option value="4">良好</option>
                                                                <option value="3">中等</option>
                                                                <option selected="selected" value="2">及格
                                                                </option>
                                                                <option value="1">不及格</option>
                                                            </select>
                                                        @else
                                                            <select class="form-control" name="score"
                                                                    id="score">
                                                                <option value="5">优秀</option>
                                                                <option value="4">良好</option>
                                                                <option value="3">中等</option>
                                                                <option value="2">及格</option>
                                                                <option selected="selected" value="1">不及格
                                                                </option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr/>

                                                <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-6">
                                                        <button type="submit" class="btn btn-primary">
                                                            确认
                                                        </button>
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">
                                                            取消
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>
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

