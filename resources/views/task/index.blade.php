@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>任务书
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
                        <th>课题</th>
                        <th>学生</th>
                        <th data-sortable="false">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($topics as $data)
                        <tr>
                            <td><a href="{{ route('topic.show', $data->id) }}">{{ $data->name }}</a></td>
                            <td>{{ $data->user_name }}</td>
                            <td>
                                <a href="{{ route('task.show', $data->id) }}" class="btn btn-md btn-info">
                                    <i class="fa fa-edit"></i>查看任务
                                </a>
                                <button class="btn btn-primary btn-md" data-toggle="modal"
                                        data-target="#{{ $data->id }}">
                                    新任务
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
                                                    新任务
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                <form role="form" method="POST" action="{{ route('task.store') }}"
                                                      class="form-horizontal">
                                                    <input type="hidden" name="topic_id" value="{{ $data->id }}">
                                                    {!! csrf_field() !!}
                                                    <div class="form-group">
                                                        <label for="content" class="col-sm-2 control-label">
                                                            任务内容
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <textarea class="form-control" name="content" id="content"
                                                                      rows="6"></textarea>
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
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@stop