@extends('layouts.app')

@section('page-header')

    <header class="intro-header">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">学生登录</div>
                <div class="panel panel-default">
                    <div class="panel-heading">登录系统</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">学号</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="id" value="{{ old('id') }}">

                                    @if ($errors->has('id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">密码</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-1">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> 记住我
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>登录
                                    </button>

                                    <a class="btn btn-link" href="{{ url('/password/email') }}">
                                        忘记密码
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

@stop
