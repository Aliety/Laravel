@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>学生列表</h3>
            </div>
            <div class="col-md-6 text-right">
                <button class="btn btn-primary btn-md" data-toggle="modal"
                        data-target="#new">
                    新学生
                </button>
                <div class="modal fade" id="new" data-id="new" tabindex="-1"
                     role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close"
                                        data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title">
                                    新学生
                                </h4>
                            </div>
                            <div class="modal-body">
                                <h4 class="modal-title" id="myModalLabel">
                                    初始密码为学号
                                </h4>
                                <form role="form" method="POST" action="/admin/user/create"
                                      class="form-horizontal">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label for="user_id" class="col-sm-2 control-label">
                                            学号
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
                        <th>学号</th>
                        <th>姓名</th>
                        <th>学院</th>
                        <th>年级</th>
                        <th data-sortable="false">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><a href="{{ url("/admin/user/$user->id") }}">{{ $user->name }}</td>
                            <td>{{ $user->college }}</td>
                            <td>{{ $user->grade }}</td>
                            <td>
                                <button class="btn btn-primary btn-md" data-toggle="modal"
                                        data-target="#{{ $user->id }}">
                                    删除
                                </button>
                                <div class="modal fade" id="{{ $user->id }}" tabIndex="-1">
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
                                                    确定删除该学生？
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST" action="{{ url("/admin/user/$user->id") }}">
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