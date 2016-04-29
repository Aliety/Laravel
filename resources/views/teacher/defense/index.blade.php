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
                        <th>课题</th>
                        <th>学生</th>
                        <th>时间</th>
                        <th>地点</th>
                        <th>状态</th>
                        <th>成绩</th>
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
                                @if ($defense->status == 0)
                                    未开始
                                @elseif ($defense->status == 1)
                                    二次答辩
                                @else
                                    已通过
                                @endif
                            </td>
                            <td>{{ $defense->score ?: '暂无' }}</td>
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
                                                                    审核意见: {{ ($defense->pivot->role == 1) ? $defense->pivot->advice : '' }}
                                                                </p>
                                                                <p>
                                                                    审核成绩: {{ ($defense->pivot_role == 1) ? $defense->pivot_score : '' }}
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6 text-center">
                                                                <p>
                                                                    小组意见: {{ ($defense->pivot_role == 2) ? $defense->pivot_advice : '' }}
                                                                </p>
                                                                <p>
                                                                    小组成绩: {{ ($defense->pivot_role == 2) ? $defense->pivot_score : '' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <hr/>
                                                        <div class="text-center">
                                                            <p>我的评价</p>
                                                        </div>
                                                        <form method="POST"
                                                              action='{{ url("/teacher/defense/check/$defense->id") }}'
                                                              class="form-horizontal">
                                                            <input type="hidden" name="_token"
                                                                   value="{{ csrf_token() }}">

                                                            <div class="form-group">
                                                                <label for="score" class="col-sm-3 control-label">
                                                                    等级评定
                                                                </label>
                                                                <div class="col-sm-6">
                                                                    @if ($defense->pivot->role == 0 && $defense->pivot->score == 5)
                                                                        <select class="form-control" name="score" id="score">
                                                                            <option selected="selected" value="5">优秀</option>
                                                                            <option value="4">良好</option>
                                                                            <option value="3">中等</option>
                                                                            <option value="2">及格</option>
                                                                            <option value="1">不及格</option>
                                                                        </select>
                                                                    @elseif ($defense->pivot->role == 0 && $defense->pivot->score == 4)
                                                                        <select class="form-control" name="score" id="score">
                                                                            <option value="5">优秀</option>
                                                                            <option selected="selected" value="4">良好</option>
                                                                            <option value="3">中等</option>
                                                                            <option value="2">及格</option>
                                                                            <option value="1">不及格</option>
                                                                        </select>
                                                                    @elseif ($defense->pivot->role == 0 && $defense->pivot->score == 3)
                                                                        <select class="form-control" name="score" id="score">
                                                                            <option value="5">优秀</option>
                                                                            <option value="4">良好</option>
                                                                            <option selected="selected" value="3">中等</option>
                                                                            <option value="2">及格</option>
                                                                            <option value="1">不及格</option>
                                                                        </select>
                                                                    @elseif ($defense->pivot->role == 0 && $defense->pivot->score == 2)
                                                                        <select class="form-control" name="score" id="score">
                                                                            <option value="5">优秀</option>
                                                                            <option value="4">良好</option>
                                                                            <option value="3">中等</option>
                                                                            <option selected="selected" value="2">及格</option>
                                                                            <option value="1">不及格</option>
                                                                        </select>
                                                                    @else
                                                                        <select class="form-control" name="score" id="score">
                                                                            <option value="5">优秀</option>
                                                                            <option value="4">良好</option>
                                                                            <option value="3">中等</option>
                                                                            <option value="2">及格</option>
                                                                            <option selected="selected" value="1">不及格</option>
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