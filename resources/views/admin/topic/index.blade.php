@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>选课列表</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('layouts.partials.errors')
                @include('layouts.partials.success')

                <table id="tags-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>名称</th>
                        <th>学生</th>
                        <th>学院</th>
                        <th>年级</th>
                        <th data-sortable="false">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td><a href="{{ url("/topic/$user->topic_id") }}">{{ $user->topic_name }}</td>
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
                                                    确定删除该学生的选课？
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST" action="{{ url("/admin/topic/user") }}">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="topic_id" value="{{ $user->topic_id }}">
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">
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