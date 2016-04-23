@extends('layouts.app')

@section('content')
    <div class="container">

        @include('layouts.partials.errors')
        @include('layouts.partials.success')

        <div class="panel panel-info">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li><a href="/message">收件夹</a></li>
                    <li><a href="/message/sent">已发送</a></li>
                    <li class="active"><a href="#">写信</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <form role="form" method="POST" action="{{ route('message.store') }}"
                      class="form-horizontal">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="rec_id" class="col-md-2 control-label">收件人</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="rec_id" id="rec_id" placeholder="请输入ID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-2 control-label">主题</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="title" id="title">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="content" class="col-sm-2 control-label">
                            内容
                        </label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="content" id="content" rows="6"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="col-sm-8 col-sm-offset-2 btn btn-primary">
                            <i class="fa fa-send"></i>
                            发送
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
