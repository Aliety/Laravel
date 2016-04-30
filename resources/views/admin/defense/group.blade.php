@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="text-center">答辩小组</h1>
        </div>
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>小组列表</h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="/admin/defense/group/create" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 新增组长
                </a>
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
                        <th>课题</th>
                        <th>导师</th>
                        <th>学生</th>
                        <th>组长</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($defenses as $defense)
                        <tr>
                            <td>{{ $defense->topic_name }}</td>
                            <td>{{ $defense->teacher_name }}</td>
                            <td>{{ $defense->user_name }}</td>
                            <td>{{ $defense->group_name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop