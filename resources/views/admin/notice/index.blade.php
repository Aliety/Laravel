@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>通知列表</h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="/admin/notice/create" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 新建
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('layouts.partials.errors')
                @include('layouts.partials.success')

                <table id="tags-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>标题</th>
                        <th>内容</th>
                        <th>时间</th>
                        <th data-sortable="false">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($notices as $notice)
                        <tr>
                            <td>{{ $notice->title }}</td>
                            <td>{{ $notice->content }}</td>
                            <td>{{ $notice->created_at }}</td>
                            <td>
                                <a href="/admin/notice/{{ $notice->id }}/edit" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 编辑
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop