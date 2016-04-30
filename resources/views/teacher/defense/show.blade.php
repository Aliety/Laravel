@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="text-center">我的审核</h1>
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
                        <th>学生</th>
                        <th>时间</th>
                        <th>地点</th>
                        <th>状态</th>
                        <th data-sortable="false">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($defenses as $defense)
                        <tr>
                            <td>{{ $defense->topic_name }}</td>
                            <td>{{ $defense->user_name }}</td>
                            <td>{{ $defense->time }}</td>
                            <td>{{ $defense->place ? : '暂定' }}</td>
                            <td>
                                @if ($defense->status == 3)
                                    通过
                                @elseif ($defense->status == 2)
                                    二次答辩
                                @else
                                    未通过
                                @endif
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-md btn-primary"
                                                data-toggle="modal" data-target="#modal{{ $defense->id }}">
                                            <i class="fa fa-eye fa-lg"></i>
                                            答辩详情
                                        </button>
                                        <div class="modal fade" id="modal{{ $defense->id }}">
                                            <div class="modal-dialog" style="width:800px;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            x
                                                        </button>
                                                        <h4 class="modal-title">{{ $defense->topic_name }}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6 text-center">
                                                                <p>
                                                                    导师意见: {{ ($defense->teach_advice) ?: '' }}
                                                                </p>
                                                                <p>
                                                                    导师成绩:
                                                                    @if ($defense->teach_score == 5)
                                                                        优秀
                                                                    @elseif ($defense->teach_score == 4)
                                                                        良好
                                                                    @elseif ($defense->teach_score == 3)
                                                                        中等
                                                                    @elseif ($defense->teach_score == 2)
                                                                        及格
                                                                    @elseif ($defense->teach_score ==1)
                                                                        不及格
                                                                    @else
                                                                        暂无
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6 text-center">
                                                                <p>
                                                                    小组意见: {{ ($defense->group_advice) ?: '' }}
                                                                </p>
                                                                <p>
                                                                    小组成绩:
                                                                    @if ($defense->group_score == 5)
                                                                        优秀
                                                                    @elseif ($defense->group_score == 4)
                                                                        良好
                                                                    @elseif ($defense->group_score == 3)
                                                                        中等
                                                                    @elseif ($defense->group_score == 2)
                                                                        及格
                                                                    @elseif ($defense->group_score ==1)
                                                                        不及格
                                                                    @else
                                                                        暂无
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <hr/>
                                                        <div class="text-center">
                                                            <p>设置与评价</p>
                                                        </div>
                                                        <form method="POST"
                                                              action='{{ url("/teacher/defense/store/$defense->id") }}'
                                                              class="form-horizontal">
                                                            <input type="hidden" name="_token"
                                                                   value="{{ csrf_token() }}">

                                                            <div class="form-group">
                                                                <label for="time" class="col-sm-3 control-label">
                                                                    答辩时间
                                                                </label>
                                                                <div class="col-sm-6">
                                                                    <input class="form-control" name="time" id="time"
                                                                           placeholder="{{ $defense->time }}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="place" class="col-sm-3 control-label">
                                                                    答辩地点
                                                                </label>
                                                                <div class="col-sm-6">
                                                                    <input class="form-control" name="place" id="place"
                                                                           placeholder="{{ $defense->place }}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="score" class="col-sm-3 control-label">
                                                                    等级评定
                                                                </label>
                                                                <div class="col-sm-6">
                                                                    @if ($defense->pivot->role == 1 && $defense->pivot->score == 5)
                                                                        <select class="form-control" name="score"
                                                                                id="score">
                                                                            <option selected="selected" value="5">优秀
                                                                            </option>
                                                                            <option value="4">良好</option>
                                                                            <option value="3">中等</option>
                                                                            <option value="2">及格</option>
                                                                            <option value="1">不及格</option>
                                                                        </select>
                                                                    @elseif ($defense->pivot->role == 1 && $defense->pivot->score == 4)
                                                                        <select class="form-control" name="score"
                                                                                id="score">
                                                                            <option value="5">优秀</option>
                                                                            <option selected="selected" value="4">良好
                                                                            </option>
                                                                            <option value="3">中等</option>
                                                                            <option value="2">及格</option>
                                                                            <option value="1">不及格</option>
                                                                        </select>
                                                                    @elseif ($defense->pivot->role == 1 && $defense->pivot->score == 3)
                                                                        <select class="form-control" name="score"
                                                                                id="score">
                                                                            <option value="5">优秀</option>
                                                                            <option value="4">良好</option>
                                                                            <option selected="selected" value="3">中等
                                                                            </option>
                                                                            <option value="2">及格</option>
                                                                            <option value="1">不及格</option>
                                                                        </select>
                                                                    @elseif ($defense->pivot->role == 1 && $defense->pivot->score == 2)
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

                                                            <div class="form-group">
                                                                <label for="status" class="col-sm-3 control-label">
                                                                    审核结果
                                                                </label>
                                                                <div class="col-sm-6">
                                                                    @if ($defense->pivot->status == 3)
                                                                        <select class="form-control" name="status"
                                                                                id="status">
                                                                            <option selected="selected" value="3">通过
                                                                            </option>
                                                                            <option value="2">二次</option>
                                                                            <option value="1">不通过</option>
                                                                        </select>
                                                                    @elseif ($defense->pivot->status == 2)
                                                                        <select class="form-control" name="status"
                                                                                id="status">
                                                                            <option selected="selected" value="2">二次
                                                                            </option>
                                                                            <option value="1">不通过</option>
                                                                        </select>
                                                                    @else
                                                                        <select class="form-control" name="status"
                                                                                id="status">
                                                                            <option value="3">通过</option>
                                                                            <option value="2">二次</option>
                                                                            <option selected="selected" value="1">不通过
                                                                            </option>
                                                                        </select>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="advice" class="col-sm-3 control-label">
                                                                    指导意见
                                                                </label>
                                                                <div class="col-sm-6">
                                                                    <textarea class="form-control" name="advice"
                                                                              id="advice"
                                                                              rows="6">{{ $defense->pivot->advice }}</textarea>
                                                                </div>
                                                            </div>

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
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop