@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>任务详情
                </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('layouts.partials.errors')
                @include('layouts.partials.success')

                <table id="courses-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>内容</th>
                        <th>发布时间</th>
                        <th data-sortable="false">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tasks as $data)
                        <tr>
                            <td>{{ $data->content }}</td>
                            <td>{{ $data->created_at }}</td>
                            <td>
                                <button class="btn btn-primary btn-md" data-toggle="modal"
                                        data-target="#{{ $data->id }}">
                                    删除
                                </button>
                                <div class="modal fade" id="{{ $data->id }}" tabIndex="-1">
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
                                                    确定删除该任务？
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST" action="{{ route('task.destroy', $data->id) }}">
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