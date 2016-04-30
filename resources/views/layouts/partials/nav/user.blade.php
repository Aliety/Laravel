<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header page-scoll">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                HQU
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}">首页</a></li>
                <li><a href="{{ url('/user/home') }}">资讯</a></li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        毕业设计 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('user/topic/show') }}">我的选题</a></li>
                        <li><a href="{{ url('user/topic/score') }}">查看成绩</a></li>
                        <li><a href="{{ url('user/topic/select') }}">选题系统</a></li>
                    </ul>
                </li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        论文报告 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('upload/report') }}">开题报告</a></li>
                        <li><a href="{{ url('upload/file') }}">论文上传</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/user/check/show') }}">中期检查</a></li>
                <li><a href="/user/task/show">任务书</a></li>
                <li><a href="/user/defense/show">论文答辩</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->id }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/user') }}"><i class="fa fa-btn fa-home"></i>个人中心</a></li>
                        <li><a href="{{ url('/message') }}"><i class="fa fa-btn fa-comment"></i>消息中心</a></li>
                        <li><a href="{{ url('/password/new') }}"><i class="fa fa-btn fa-random"></i>修改密码</a></li>
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>退出登录</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>