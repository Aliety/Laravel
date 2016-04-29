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
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        用户管理 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/admin/user') }}">学生管理</a></li>
                        <li><a href="{{ url('/admin/teacher') }}">教师管理</a></li>
                    </ul>
                </li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        资讯 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/admin/news') }}">新闻</a></li>
                        <li><a href="{{ url('/admin/notice') }}">通知</a></li>
                    </ul>
                </li>
                <li><a href="/admin/upload">文件管理</a></li>
                <li><a href="/admin/topic">课题管理</a></li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        论文答辩 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/defense/show">答辩信息</a></li>
                        <li><a href="{{ url('/admin/defense/check') }}">答辩审核</a></li>
                        <li><a href="{{ url('/admin/defense/group') }}">答辩小组</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">管理员</a></li>
                <li>
                    <a href="{{ url('/admin/logout') }}">
                        <i class="fa fa-btn fa-sign-out"></i>
                        退出登录
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>