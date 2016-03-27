@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>Topic State
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
                        <th>选课学生</th>
                        <th>人数限制</th>
                        <th data-sortable="false">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $topic->name }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $topic->number }}</td>
                            <td>
                                @if ($user->pivot->active)
                                    <button class="btn btn-success btn-md" disabled="disabled">
                                        已确认
                                    </button>
                                @elseif ($count >= $topic->number)
                                    <button class="btn btn-default btn-md" disabled="disabled">
                                        确认选课
                                    </button>
                                @else
                                    <a href="{{ url('/topic/active', [$topic->id, $user->id]) }}"
                                       class="btn btn-md btn-info">
                                        <i class="fa fa-edit"></i>确认选课
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@stop