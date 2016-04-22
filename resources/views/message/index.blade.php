@extends('layouts.app')

@section('content')
    <div class="container">

        @include('layouts.partials.errors')
        @include('layouts.partials.success')

        <div class="panel panel-info">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#">收件夹</a></li>
                    <li><a href="#">已发送</a></li>
                    <li><a href="#">写信</a></li>
                </ul>
            </div>
            <table class="table">
                <th>产品</th><th>价格 </th>
                <tr><td>产品 A</td><td>200</td></tr>
                <tr><td>产品 B</td><td>400</td></tr>
            </table>
        </div>
        @foreach($messages as $message)
            <p>{{ $message->title }}</p>
        @endforeach

    </div>
@stop
