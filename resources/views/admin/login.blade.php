@extends('layouts.app')

@section('page-header')

    <header class="intro-header">
        <div class="container">
            <div class="intro-text">
                <div class="intro-heading">管理员登录</div>
                    <div class="panel panel-default">
                        <div class="panel-heading">登录系统</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/login') }}">
                                {!! csrf_field() !!}

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label">帐号</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
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
                                    <div class="col-md-2 col-md-offset-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember"> 记住我
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 control-label">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-sign-in"></i>登录
                                        </button>

                                        <a class="btn btn-link" href="{{ url('/admin/password/email') }}">忘记密码？</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection
