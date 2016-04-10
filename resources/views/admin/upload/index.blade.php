@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h3 class="pull-left">文件列表</h3>
                <div class="pull-left">
                    <ul class="breadcrumb">
                        @foreach ($breadcrumbs as $path => $disp)
                            <li><a href="/admin/upload?folder={{ $path }}">{{ $disp }}</a></li>
                        @endforeach
                        <li class="active">{{ $folderName }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-success btn-md" data-toggle="modal"
                        data-target="#modal-folder-create">
                    <i class="fa fa-plus-circle"></i> 新建文件夹
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('layouts.partials.errors')
                @include('layouts.partials.success')

                <table id="uploads-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>名陈</th>
                        <th>时间</th>
                        <th>大小</th>
                        <th data-sortable="false">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($subfolders as $path => $name)
                        <tr>
                            <td>
                                <a href="/admin/upload?folder={{ $path }}">
                                    <i class="fa fa-folder fa-lg fa-fw"></i> {{ $name }}
                                </a>
                            </td>
                            <td>-</td>
                            <td>-</td>
                            <td>
                                <button type="button" class="btn btn-xs btn-danger"
                                        onclick="delete_folder('{{ $name }}')">
                                    <i class="fa fa-times-circle fa-lg"></i>
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($files as $file)
                        <tr>
                            <td>
                                <a href="{{ $file['webPath'] }}">
                                    <i class="fa fa-file-o fa-lg fa-fw"></i>
                                    {{ $file['name'] }}
                                </a>
                            </td>
                            <td>{{ $file['modified']->format('j-M-y g:ia') }}</td>
                            <td>{{ human_filesize($file['size']) }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-md btn-danger"
                                                onclick="delete_file('{{ $file['name'] }}')">
                                            <i class="fa fa-times-circle fa-lg"></i>
                                            删除
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <form method="POST" action="/file/download">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="path" value="{{ $file['fullPath'] }}">
                                            <button type="submit" class="btn btn-md btn-primary">
                                                <i class="fa fa-download fa-lg"></i>
                                                下载
                                            </button>
                                        </form>
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

    @include('admin.upload._modals')

@stop

@section('scripts')
    <script>
        function delete_file(name) {
            $("#delete-file-name1").html(name);
            $("#delete-file-name2").val(name);
            $("#modal-file-delete").modal("show");
        }

        function delete_folder(name) {
            $("#delete-folder-name1").html(name);
            $("#delete-folder-name2").val(name);
            $("#modal-folder-delete").modal("show");
        }

        $(function () {
            $("#uploads-table").DataTable();
        });
    </script>
@stop