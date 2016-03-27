@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>Topic Listing
                </h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('topic.create') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i>New Topic
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('layouts.partials.errors')
                @include('layouts.partials.success')

                <table id="courses-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Number</th>
                        <th data-sortable="false">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($topics as $data)
                        <tr>
                            <td><a href="{{ route('topic.show', $data->id) }}">{{ $data->name }}</a></td>
                            <td>{{ $data->number }}</td>
                            <td>
                                <a href="{{ route('topic.edit', $data->id) }}" class="btn btn-md btn-info">
                                    <i class="fa fa-edit"></i>编辑
                                </a>
                                <a href="{{ url('topic/state', $data->id) }}" class="btn btn-md btn-info">
                                    <i class="fa fa-edit"></i>选课名单
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