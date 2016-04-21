@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>课题列表</h3>
            </div>
        </div>

        @include('layouts.partials.errors')
        @include('layouts.partials.success')
        @include('layouts.partials.msg')

        <form class="form-inline" id="ajax-form" role="form" method="POST" action="{{ url('/user/topic/bread') }}">
            {!! csrf_field() !!}
            <div class="form-group">
                <select class="form-control" name="college" id="select1">
                    <option value="all">请选择学院</option>
                    <option value="信息学院">信息学院</option>
                    <option value="计算机学院">计算机学院</option>
                </select>
            </div>

            <div class="form-group">
                <select class="form-control" name="grade" id="select2">
                    <option value="all">请选择年级</option>
                    <option value="2012级">2012级</option>
                    <option value="2012级">2013级</option>
                </select>
            </div>

            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <button id="ajax-btn" type="submit" class="btn btn-primary btn-md">
                        <i class="fa fa-disk-o"></i>
                        查找
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table id="topics" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>课题名称</th>
                    <th>学院</th>
                    <th>年级</th>
                    <th>教师</th>
                    <th>可选人数</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="table-body">
                @foreach ($datas as $data)
                    <tr>
                        <td><a href="{{ url("topic/$data->id") }}">{{ $data->name }}</td>
                        <td>{{ $data->college }}</td>
                        <td>{{ $data->grade }}</td>
                        <td><a href="{{ url("/user/teacher/$data->teacher_id") }}">{{ $data->teacher_name }}</td>
                        <td>{{ $data->number }}</td>
                        <td>
                            <button class="btn btn-primary btn-md" data-toggle="modal"
                                    data-target="#{{ $data->id }}">
                                选择
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
                                                课题选择
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            确定选择 {{ $data->name }} ?
                                        </div>
                                        <div class="modal-footer">
                                            <form role="form" method="POST" action="{{ url('user/topic/confirm') }}">
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-check"></i>
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
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
