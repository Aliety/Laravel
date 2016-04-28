@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h3 class="pull-left">中期检查</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('layouts.partials.errors')
                @include('layouts.partials.success')

                <table id="uploads-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>课题名称</th>
                        <th>选课学生</th>
                        <th>审核状态</th>
                        <th>更新时间</th>
                        <th data-sortable="false">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($topics as $topic)
                        <tr>
                            <td>{{ $topic['name'] }}</td>
                            <td>{{ $topic['user_name'] }}</td>
                            <td>{{ $topic['check'] ? ($topic->check->active ? '已通过' : '未通过') : '未检查'}}</td>
                            <td>{{ $topic['updated_at'] }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-md btn-primary"
                                                data-toggle="modal" data-target="#modal{{ $topic->id }}">
                                            <i class="fa fa-check fa-lg"></i>
                                            操作
                                        </button>
                                        <div class="modal fade" id="modal{{ $topic->id }}">
                                            <div class="modal-dialog" style="width:800px;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            x
                                                        </button>
                                                        <h4 class="modal-title">{{ $topic->name }}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6 text-center">
                                                                <p>难易程度: {{ $topic->level }}</p>
                                                                <p>工作量: {{ $topic->week }} 周</p>
                                                            </div>
                                                            <div class="col-md-6 text-center">
                                                                <p>要求: {{ $topic->requirement }}</p>
                                                                <p>类型: {{ $topic->type }}</p>
                                                            </div>
                                                        </div>
                                                        <hr/>
                                                        <form method="POST"
                                                              action='{{ url("/teacher/check", $topic->id) }}'
                                                              class="form-horizontal">
                                                            <input type="hidden" name="_token"
                                                                   value="{{ csrf_token() }}">

                                                            <div class="form-group">
                                                                <label for="report" class="col-sm-3 control-label">
                                                                    开题准备
                                                                </label>
                                                                <div class="col-sm-6">
                                                                    @if (isset($topic->check->report_status) && $topic->check->report_status ==2)
                                                                        <select class="form-control" name="report"
                                                                                id="report">
                                                                            <option value="2">好</option>
                                                                            <option value="1">一般</option>
                                                                            <option value="0">差</option>
                                                                        </select>
                                                                    @elseif (isset($topic->check->report_status) && $topic->check->report_status ==1)
                                                                        <select class="form-control" name="report"
                                                                                id="report">
                                                                            <option value="2">好</option>
                                                                            <option selected = "selected" value="1">一般</option>
                                                                            <option value="0">差</option>
                                                                        </select>
                                                                    @else
                                                                        <select class="form-control" name="report"
                                                                                id="report">
                                                                            <option value="2">好</option>
                                                                            <option value="1">一般</option>
                                                                            <option selected = "selected" value="0">差</option>
                                                                        </select>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="topic" class="col-sm-3 control-label">
                                                                    论文进度
                                                                </label>
                                                                <div class="col-sm-6">
                                                                    @if (isset($topic->check->topic_status) && $topic->check->topic_status ==2)
                                                                        <select class="form-control" name="topic"
                                                                                id="topic">
                                                                            <option value="2">基本完成</option>
                                                                            <option value="1">初稿</option>
                                                                            <option value="0">未开始</option>
                                                                        </select>
                                                                    @elseif (isset($topic->check->topic_status) && $topic->check->topic_status ==1)
                                                                        <select class="form-control" name="topic"
                                                                                id="topic">
                                                                            <option value="2">基本完成</option>
                                                                            <option selected = "selected" value="1">初稿</option>
                                                                            <option value="0">未开始</option>
                                                                        </select>
                                                                    @else
                                                                        <select class="form-control" name="topic"
                                                                                id="topic">
                                                                            <option value="2">基本完成</option>
                                                                            <option value="1">初稿</option>
                                                                            <option selected = "selected" value="0">未开始</option>
                                                                        </select>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="teach" class="col-sm-3 control-label">
                                                                    教学状态
                                                                </label>
                                                                <div class="col-sm-6">
                                                                    @if (isset($topic->check->teach_status) && $topic->check->teach_status ==2)
                                                                        <select class="form-control" name="teach"
                                                                                id="teach">
                                                                            <option value="2">好</option>
                                                                            <option value="1">一般</option>
                                                                            <option value="0">差</option>
                                                                        </select>
                                                                    @elseif (isset($topic->check->teach_status) && $topic->check->teach_status ==1)
                                                                        <select class="form-control" name="teach"
                                                                                id="teach">
                                                                            <option value="2">好</option>
                                                                            <option selected = "selected" value="1">一般</option>
                                                                            <option value="0">差</option>
                                                                        </select>
                                                                    @else
                                                                        <select class="form-control" name="teach"
                                                                                id="teach">
                                                                            <option value="2">好</option>
                                                                            <option value="1">一般</option>
                                                                            <option selected = "selected" value="0">差</option>
                                                                        </select>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="total" class="col-sm-3 control-label">
                                                                    总体评价
                                                                </label>
                                                                <div class="col-sm-6">
                                                                    @if (isset($topic->check->total) && $topic->check->total ==2)
                                                                        <select class="form-control" name="total"
                                                                                id="total">
                                                                            <option value="2">好</option>
                                                                            <option value="1">一般</option>
                                                                            <option value="0">差</option>
                                                                        </select>
                                                                    @elseif (isset($topic->check->total) && $topic->check->total ==1)
                                                                        <select class="form-control" name="total"
                                                                                id="total">
                                                                            <option value="2">好</option>
                                                                            <option selected = "selected" value="1">一般</option>
                                                                            <option value="0">差</option>
                                                                        </select>
                                                                    @else
                                                                        <select class="form-control" name="total"
                                                                                id="total">
                                                                            <option value="2">好</option>
                                                                            <option value="1">一般</option>
                                                                            <option selected = "selected" value="0">差</option>
                                                                        </select>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <hr/>

                                                            <div class="form-group">
                                                                <label for="advice" class="col-sm-3 control-label">
                                                                    指导意见
                                                                </label>
                                                                <div class="col-sm-6">
                                                                    <textarea class="form-control" name="advice"
                                                                              id="advice"
                                                                              rows="6">{{ isset($topic->check->advice) ? ($topic->check->advice) : '' }}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="col-sm-offset-3 col-sm-6">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" name="check"> 通过检查
                                                                        </label>
                                                                    </div>
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
