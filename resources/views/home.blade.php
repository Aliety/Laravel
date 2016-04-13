@extends('layouts.app')

@section('content')

    @include('layouts.partials.success')
    @include('layouts.partials.errors')

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">最新资讯</h2>
            </div>
        </div>
        <hr/>
        <div class="row text-center">
            <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-book fa-stack-1x fa-inverse"></i>
                    </span>
                <h4 class="service-heading">院系新闻</h4>
                @foreach ($news as $new)
                    <p class="text-muted">
                        {{ $new->created_at->format('M-j-Y') }}
                        --
                        {{ $new->content }}
                    </p>
                @endforeach
            </div>
            <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                <h4 class="service-heading">相关通知</h4>
                @foreach ($notices as $notice)
                    <p class="text-muted">
                        {{ $notice->created_at->format('M-j-Y') }}
                        --
                        {{ $notice->content }}
                    </p>
                @endforeach
            </div>
            <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-bus fa-stack-1x fa-inverse"></i>
                    </span>
                <h4 class="service-heading">直通车</h4>
                <p class="text-muted"><a href="http://www.hqu.edu.cn/">华大官网</a></p>
                <p class="text-muted"><a href="http://jwc.hqu.edu.cn/">教务处</a></p>
                <p class="text-muted"><a href="http://i.hqu.edu.cn/">信息门户</a></p>
            </div>
        </div>
    </div>
@stop
