@extends('layouts.app')

@section('content')
    <div class="container">

        @include('layouts.partials.errors')
        @include('layouts.partials.success')

        <div class="panel panel-info">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#">收件夹</a></li>
                    <li><a href="message/sent">已发送</a></li>
                    <li><a href="message/create">写信</a></li>
                </ul>
            </div>

            <table class="table">
                <th>主题</th>
                <th>发件人</th>
                <th>发送时间</th>
                <th>状态</th>
                <th>操作</th>
                @foreach($messages as $message)
                    <tr>
                        <td>{{ $message->title }}</td>
                        <td>{{ $message->send_id }}</td>
                        <td>{{ $message->created_at }}</td>
                        <td id="{{ $message->id.'status' }}">{{ ($message->status == 0) ? '未读' : '已读' }}</td>
                        <td>
                            <div class="row">
                                <button class="btn btn-primary btn-xs" data-toggle="modal"
                                        id="{{ $message->id.'ajax' }}" data-target="#{{ $message->id }}">
                                    <i class="fa fa-eye"></i>查看
                                </button>

                                <script>
                                    $(document).ready(function () {
                                        $('#{{ $message->id.'ajax' }}').click(function (e) {
                                            e.preventDefault();
                                            $.ajax({
                                                url: '/ajax',
                                                type: 'post',
                                                data: { message_id : "{{ $message->id }}"},
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                                },
                                                success: function (data) {
                                                    $('#{{ $message->id.'status' }}').text(data.state);
                                                    $('div#{{ $message->id.'model' }}').modal();
                                                },
                                                dataType: 'json',
                                            });
                                        });
                                    });
                                </script>

                                <div class="modal fade" id="{{ $message->id.'model' }}" data-id="{{ $message->id }}"
                                     tabindex="-1"
                                     role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                        data-dismiss="modal" aria-hidden="true">
                                                    &times;
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">
                                                    内容
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                {{ $message->content }}
                                            </div>
                                            <div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-xs btn-default"
                                                            data-dismiss="modal">关闭
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-danger btn-xs" data-toggle="modal"
                                        data-target="#{{ $message->id.'delete' }}">
                                    <i class="fa fa-remove"></i>删除
                                </button>
                                <div class="modal fade" id="{{ $message->id.'delete' }}"
                                     data-id="{{ $message->id.'delete' }}" tabindex="-1"
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
                                                    删除
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                <p class="lead">
                                                    <i class="fa fa-question-circle fa-lg"></i>
                                                    确定删除该消息？
                                                </p>
                                            </div>
                                            <div>
                                                <div class="modal-footer">
                                                    <form method="POST" action="{{ url("/message/linkDelete/$message->id") }}">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">
                                                            取消
                                                        </button>
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fa fa-times-circle"></i> 确定
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop
