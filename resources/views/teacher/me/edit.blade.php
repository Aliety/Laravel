@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>Edit</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Form</h3>
                    </div>
                    <div class="panel-body">

                        @include('layouts.partials.errors')
                        @include('layouts.partials.success')

                        <form class="form-horizontal" role="form" method="POST" action="{{ route('teacher.update', ['id' => $id]) }}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="PUT">

                            <div class="form-group">
                                <label for="name" class="col-md-3 control-label">Name</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="college" class="col-md-3 control-label">College</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="college" id="college" value="{{ $college }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="major" class="col-md-3 control-label">Major</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="major" id="major" value="{{ $major }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title" class="col-md-3 control-label">Title</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="title" id="title" value="{{ $title }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tel" class="col-md-3 control-label">Tel</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="tel" id="tel" value="{{ $tel }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="profile" class="col-md-3 control-label">Profile</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="profile" id="profile" value="{{ $profile }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary btn-md">
                                        <i class="fa fa-save"></i>
                                        Save Changes
                                    </button>
                                    <a href="{{ route('user.index') }}" class="btn btn-primary btn-md">
                                        Back
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection