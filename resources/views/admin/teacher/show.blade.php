@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>教师列表</h3>
            </div>
            <div class="col-md-6 text-right">
                <button class="btn btn-primary btn-md" data-toggle="modal"
                        data-target="#new">
                    新教师
                </button>
                <div class="modal fade" id="new" data-id="new" tabindex="-1"
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
                                    新教师
                                </h4>
                            </div>
                            <div class="modal-body">
                                <h4 class="modal-title" id="myModalLabel">
                                    初始密码与工号相同
                                </h4>
                                <form role="form" method="POST" action="/admin/teacher/create"
                                      class="form-horizontal">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label for="user_id" class="col-sm-2 control-label">
                                            工号
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="user_id"
                                                   name="id">
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
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('layouts.partials.errors')
                @include('layouts.partials.success')

                <table id="tags-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>工号</th>
                        <th>姓名</th>
                        <th>学院</th>
                        <th>职称</th>
                        <th data-sortable="false">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->id }}</td>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->college }}</td>
                            <td>{{ $teacher->title }}</td>
                            <td>
                                <button class="btn btn-primary btn-md" data-toggle="modal"
                                        data-target="#{{ $teacher->id }}">
                                    删除
                                </button>
                                <div class="modal fade" id="{{ $teacher->id }}" tabIndex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    ×
                                                </button>
                                                <h4 class="modal-title">删除确认</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p class="lead">
                                                    <i class="fa fa-question-circle fa-lg"></i>
                                                    确定删除该教师？
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST" action="{{ url("/admin/teacher/$teacher->id") }}">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        取消
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-times-circle"></i> 确定
                                                    </button>
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
    </div>
@stop