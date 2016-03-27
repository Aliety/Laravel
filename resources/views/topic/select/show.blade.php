@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>Topic Showing</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table id="courses" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Teacher</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->teacher_name }}</td>
                        <td>
                            @if ($data->pivot->active)
                                <button class="btn btn-success btn-md" disabled="disabled"
                                        data-target="#{{ $data->id }}">
                                    已确认
                                </button>
                            @else
                                <button class="btn btn-primary btn-md" data-toggle="modal"
                                        data-target="#{{ $data->id }}">
                                    Delete
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
                                                    Delete Topic
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure to delete the topic {{ $data->name }} ?
                                            </div>
                                            <div class="modal-footer">
                                                <form role="form" method="POST" action="{{ url('user/topic/delete') }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-floppy-o"></i>\
                                                        Delete
                                                    </button>
                                                    <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Cancle
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection