<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">

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
                <li><a href="{{ url('/teacher/home') }}">资讯</a></li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        毕业设计 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/topic') }}">我的课题</a></li>
                        <li><a href="{{ url('/teacher/topic/score') }}">成绩评定</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/teacher/thesis') }}">论文</a></li>
                <li><a href="{{ route('task.index') }}">任务书</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::guard('teacher')->user()->id }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/teacher') }}"><i class="fa fa-btn fa-home"></i>个人中心</a></li>
                        <li><a href="{{ url('/message') }}"><i class="fa fa-btn fa-comment"></i>消息中心</a></li>
                        <li><a href="{{ url('/teacher/password/new') }}"><i class="fa fa-btn fa-random"></i>修改密码</a></li>
                        <li><a href="{{ url('/teacher/logout') }}"><i class="fa fa-btn fa-sign-out"></i>退出登录</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>