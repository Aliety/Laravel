@extends('layouts.app')

@section('page-header')
    <header class="intro-header"
            style=" background-size: 100%;
                    background-image: url('{{ page_image() }}') ">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Welcome To Our Studio!</div>
                <div class="intro-heading">It's Nice To Meet You</div>
                <button class="page-scroll btn btn-xl" data-toggle="modal"
                        data-target="#enter">
                    进入系统
                </button>
                <div class="modal fade" id="enter" data-id="enter" tabindex="-1"
                     role="dialog"
                     aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close"
                                        data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title" id="myModalLabel" style="color: #0000AA">
                                    角色选择
                                </h4>
                            </div>
                            <div class="modal-body">
                                <a href="/user/enter" class="btn btn-primary bt-lg">学生</a>
                                <a href="/teacher/enter" class="btn btn-primary bt-lg">教师</a>
                                <a href="/admin/enter" class="btn btn-primary bt-lg">管理员</a>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default"
                                        data-dismiss="modal">取消
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
@stop
