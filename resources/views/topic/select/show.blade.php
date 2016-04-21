@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>我的选题</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table id="courses" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>课题名称</th>
                    <th>教师</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td><a href="{{ url("topic/$data->id") }}">{{ $data->name }}</td>
                        <td><a href="{{ url("/user/teacher/$data->teacher_id") }}">{{ $data->teacher_name }}</td>
                        <td>
                            @if ($data->pivot->active)
                                <button class="btn btn-success btn-md" disabled="disabled"
                                        data-target="#{{ $data->id }}">
                                    已确认
                                </button>
                            @else
                                <button class="btn btn-primary btn-md" data-toggle="modal"
                                        data-target="#{{ $data->id }}">
                                    删除
                                </button>

                                <div class="modal fade" id="{{ $data->id }}" data-id="{{ $data->id }}" tabindex="-1"
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
                                                    删除选课
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                确定删除课题 {{ $data->name }} ?
                                            </div>
                                            <div class="modal-footer">
                                                <form role="form" method="POST" action="{{ url('user/topic/delete') }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-check"></i>\
                                                        确认
                                                    </button>
                                                    <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">取消
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection