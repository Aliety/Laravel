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
                        <th>检查状态</th>
                        <th>开题情况</th>
                        <th>论文进度</th>
                        <th>教学状态</th>
                        <th>总体评价</th>
                        <th data-sortable="false">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $result->name }}</td>
                            <td>{{ $result->active ? '已通过' : '未通过' }}</td>
                            <td>{{ $result->report_status }}</td>
                            <td>{{ $result->topic_status }}</td>
                            <td>{{ $result->teach_status }}</td>
                            <td>{{ $result->total }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-md btn-primary"
                                                data-toggle="modal" data-target="#modal">
                                            <i class="fa fa-eye fa-lg"></i>
                                            指导意见
                                        </button>
                                        <div class="modal fade" id="modal">
                                            <div class="modal-dialog" style="width:800px;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            x
                                                        </button>
                                                        <h4 class="modal-title">{{ $result->name }}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <p>{{ $result->advice }}</p>
                                                        </div>
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
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
