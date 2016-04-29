@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="text-center">新增审核</h1>
        </div>
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>教师列表</h3>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-sm-12">

                @include('layouts.partials.errors')
                @include('layouts.partials.success')

                <table id="tags-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>教师</th>
                        <th>学院</th>
                        <th>职称</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->college }}</td>
                            <td>{{ $teacher->title }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-md btn-primary"
                                                data-toggle="modal" data-target="#modal{{ $teacher->id }}">
                                            <i class="fa fa-check fa-lg"></i>
                                            设为审核
                                        </button>
                                        <div class="modal fade" id="modal{{ $teacher->id }}">
                                            <div class="modal-dialog" style="width:800px;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            x
                                                        </button>
                                                        <h4 class="modal-title">
                                                            添加审核
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="text-center">
                                                                <p>
                                                                     确定添加 {{ $teacher->name }} 为审核员?
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <hr/>
                                                        <form method="POST"
                                                              action='{{ url("/teacher/defense/check/$teacher->id") }}'
                                                              class="form-horizontal">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                            <div class="form-group">
                                                                <label for="num" class="col-sm-3 control-label">
                                                                    审核数量
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control" name="num" id="num" placeholder="请输入数字">
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