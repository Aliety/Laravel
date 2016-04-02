@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>新闻列表</h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="/admin/news/create" class="btn btn-success btn-md">
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
                    @foreach ($news as $new)
                        <tr>
                            <td>{{ $new->title }}</td>
                            <td>{{ $new->content }}</td>
                            <td>{{ $new->created_at }}</td>
                            <td>
                                <a href="/admin/news/{{ $new->id }}/edit" class="btn btn-xs btn-info">
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