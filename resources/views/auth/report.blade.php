@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h3 class="pull-left">上传开题报告</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('layouts.partials.errors')
                @include('layouts.partials.success')

                <table id="uploads-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>课题</th>
                        <th>报告</th>
                        <th>状态</th>
                        <th>更新时间</th>
                        <th data-sortable="false">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $report['topic'] }}</td>
                        <td>{{ $report['name'] }}</td>
                        <td>{{ $report['active'] ? '已通过' : '未通过' }}</td>
                        <td>{{ $report['updated_at'] }}</td>
                        <td>
                            @if ( $report['topic'] == '未确认选课')
                                <button class="btn btn-success btn-md" disabled="disabled">
                                    上传
                                </button>
                            @else
                                <button type="button" class="btn btn-md btn-primary"
                                        data-toggle="modal" data-target="#modal-file-upload">
                                    <i class="fa fa-upload fa-lg"></i>
                                    上传
                                </button>
                                <button type="button" class="btn btn-md btn-primary"
                                        data-toggle="modal" data-target="#modal-check">
                                    <i class="fa fa-eye fa-lg"></i>
                                    指导意见
                                </button>
                                <div class="modal fade" id="modal-check">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    x
                                                </button>
                                                <h4 class="modal-title">修改建议</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ $report['advice'] }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">
                                                    关闭
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-file-upload">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="/upload/report" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="folder" value="{{  $report['name'] }}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            x
                        </button>
                        <h4 class="modal-title">上传开题报告</h4>
                    </div>
                    <div class="modal-body">
                        <p class="lead">
                            <i class="fa fa-question-circle fa-md">
                                注意：重新上传会覆盖，请注意备份。
                            </i>
                        </p>
                        <div class="form-group">
                            <label for="file" class="col-sm-3 control-label">
                                选择文件
                            </label>
                            <div class="col-sm-8">
                                <input type="file" id="file" name="file">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            取消
                        </button>
                        <button type="submit" class="btn btn-primary">
                            上传
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script>
        $(function () {
            $("#uploads-table").DataTable();
        });
    </script>
@stop