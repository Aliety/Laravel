@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2>This is a heading</h2>
        <p>This is a paragraph.</p>
        <p>This is another paragraph.</p>
        <h1 onclick="this.innerHTML='谢谢!'">请点击该文本</h1>
        <button>Click me</button>
        <script type="text/javascript">
            $(document).ready(function(){
                $("button").click(function(){
                    $("p").hide();
                });
            });
        </script>
    </div>
@endsection