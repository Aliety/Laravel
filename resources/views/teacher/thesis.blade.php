@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h3 class="pull-left">学生论文</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('layouts.partials.errors')
                @include('layouts.partials.success')

                <table id="uploads-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>论文</th>
                        <th>学生</th>
                        <th>状态</th>
                        <th>答辩时间</th>
                        <th data-sortable="false">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($theses as $thesis)
                        <tr>
                            <td>{{ $thesis['original_name'] }}</td>
                            <td>{{ $thesis['user_name'] }}</td>
                            <td>{{ $thesis['active'] ? '已通过' : '未审核' }}</td>
                            <td>{{ $thesis['defense_time'] }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <form method="POST" action="/file/download">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="name" value="{{  $thesis['original_name'] }}">
                                            <input type="hidden" name="path"
                                                   value="{{  $thesis['save_folder'].'/'.$thesis['save_name'] }}">
                                            <button type="submit" class="btn btn-md btn-primary">
                                                <i class="fa fa-download fa-lg"></i>
                                                下载
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-md btn-primary"
                                                data-toggle="modal" data-target="#modal-check">
                                            <i class="fa fa-check fa-lg"></i>
                                            操作
                                        </button>
                                        <div class="modal fade" id="modal-check">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            x
                                                        </button>
                                                        <h4 class="modal-title">论文管理</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST"
                                                              action="{{ url('/thesis/check', $thesis['id']) }}"
                                                              class="form-horizontal">
                                                            <input type="hidden" name="_token"
                                                                   value="{{ csrf_token() }}">
                                                            <div class="form-group">
                                                                <label for="defense_time"
                                                                       class="col-sm-3 control-label">
                                                                    答辩时间
                                                                </label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control"
                                                                           id="defense_time"
                                                                           name="defense_time"
                                                                           value="{{ $thesis['defense_time'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-offset-3 col-sm-6">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" name="check"> 请记住我
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-offset-3 col-sm-6">
                                                                    <button type="submit" class="btn btn-primary">确认</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">
                                                            取消
                                                        </button>
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

@section('scripts')
    <script>
        $(function () {
            $("#uploads-table").DataTable();
        });
    </script>
@stop