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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tasks as $data)
                        <tr>
                            <td>{{ $data->content }}</td>
                            <td>{{ $data->created_at }}</td>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@stop