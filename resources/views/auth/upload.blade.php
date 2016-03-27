@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h3 class="pull-left">上传论文</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('layouts.partials.errors')
                @include('layouts.partials.success')

                <table id="uploads-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>课题</th>
                        <th>论文</th>
                        <th data-sortable="false">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $topic }}</td>
                        <td>{{ $name }}</td>
                        <td>
                            <button type="button" class="btn btn-md btn-primary"
                                    data-toggle="modal" data-target="#modal-file-upload">
                                <i class="fa fa-upload fa-lg"></i>
                                上传
                            </button>
                            <form method="POST" action="/file/download">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="name" value="{{ $name }}">
                                <input type="hidden" name="path" value="{{ $path }}">
                                <button type="submit" class="btn btn-md btn-primary">
                                    <i class="fa fa-download fa-lg"></i>
                                    下载
                                </button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-file-upload">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="/upload/file" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="folder" value="{{ $name }}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            x
                        </button>
                        <h4 class="modal-title">Upload New File</h4>
                    </div>
                    <div class="modal-body">
                        <p class="lead">
                            <i class="fa fa-question-circle fa-md">
                                注意：重新上传会覆盖，请注意备份。
                            </i>
                        </p>
                        <div class="form-group">
                            <label for="file" class="col-sm-3 control-label">
                                File
                            </label>
                            <div class="col-sm-8">
                                <input type="file" id="file" name="file">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Upload File
                        </button>
                    </div>
                </form>
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