<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="token" name="token" value = "{{ csrf_token() }}"/>
    <title>易事达智慧办公--中油七建定制版</title>
    <link href="http://libs.useso.com/js/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://libs.useso.com/js/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href='http://fonts.useso.com/css?family=Raleway:400,500,600,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/vendor.css">
</head>
<body>
<!--[if lt IE 10]>
<p class="browserupgrade">您的浏览器已<strong>面临淘汰</strong>,到这里<a href="staraw.com/bye.html/">升级靠谱浏览器</a>提升安全及体验。</p>
<![endif]-->

{{--START MASK--}}
@yield('maskLayer')
<div class="loading-container">
    <div class="spinner">
    </div>
</div>

{{--提示框--}}
<div class="star-alert alert alert-success" role="alert" style="display:none;">
    <span>我会被自动调用</span>
</div>

       {{--START SIDEBAR--}}
@inject('menu','App\Estar\Composers\Estar')
<aside class="left-panel">

    <div class="text-center">
        <img class="responsive" src="/img/logo.png"  alt="...">
        <h5 class="current-time">{{$menu->showTime()}}</h5>
    </div>


    <nav class="navigation" id="sidemenu">
        <ul class="list-unstyled">
            {{$menu->makeMenu()}}
        </ul>
    </nav>

</aside>
{{--START CONTENT--}}
            <section class="content">
                {{--START NAV--}}
                <header class="top-head container-fluid">
                    <button type="button" class="navbar-toggle pull-left">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <form role="search" class="navbar-left app-search pull-left hidden-xs">
                        <input type="text" placeholder="输入搜索关键字" class="form-control form-control-circle">
                    </form>

                    <nav class=" navbar-default hidden-xs" role="navigation">
                        <ul class="nav navbar-nav">
                            <li><a href="#">帮助中心</a></li>
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">常用工具 <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>

                    <ul class="nav-toolbar">

                        <li class="dropdown"><a href="#" data-toggle="dropdown"><i class="fa fa-user"></i></a>
                            <div class="dropdown-menu arrow pull-right  panel panel-default arrow-top-right notifications">
                                <div class="panel-heading">
                                    您好,{{Auth::user()->name}}
                                </div>

                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        修改个人资料
                                    </a>

                                    <a href="{{url('auth/logout')}}" class="list-group-item">
                                        退出登录
                                    </a>
                                </div>

                            </div>
                        </li>

                        <li class="dropdown"><a href="#" data-toggle="dropdown"><i class="fa fa-bell-o"></i><span class="badge">3</span></a>
                            <div class="dropdown-menu arrow pull-right md panel panel-default arrow-top-right notifications">
                                <div class="panel-heading">
                                    提醒
                                </div>

                                <div class="list-group">

                                    <a href="#" class="list-group-item">
                                        <p>Installing App v1.2.1<small class="pull-right text-muted">45% Done</small></p>
                                        <div class="progress progress-xs no-margn progress-striped active">
                                            <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                <span class="sr-only">45% Complete</span>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        Fusce dapibus molestie tincidunt. Quisque facilisis libero eget justo iaculis
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <p>Server Status</p>
                                        <div class="progress progress-xs no-margn">
                                            <div class="progress-bar progress-bar-success" style="width: 35%">
                                                <span class="sr-only">35% Complete (success)</span>
                                            </div>
                                            <div class="progress-bar progress-bar-warning" style="width: 20%">
                                                <span class="sr-only">20% Complete (warning)</span>
                                            </div>
                                            <div class="progress-bar progress-bar-danger" style="width: 10%">
                                                <span class="sr-only">10% Complete (danger)</span>
                                            </div>
                                        </div>
                                    </a>



                                    <a href="#" class="list-group-item">
                                        <div class="media">
                                            <span class="label label-danger media-object img-circle pull-left">Danger</span>
                                            <div class="media-body">
                                                <h5 class="media-heading">Lorem ipsum dolor sit consect..</h5>
                                            </div>
                                        </div>
                                    </a>


                                    <a href="#" class="list-group-item">
                                        <p>Server Status</p>
                                        <div class="progress progress-xs no-margn">
                                            <div style="width: 60%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-info">
                                                <span class="sr-only">60% Complete (warning)</span>
                                            </div>
                                        </div>
                                    </a>


                                </div>

                            </div>
                        </li>
                        <li class="dropdown"><a href="#" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu lg pull-right arrow panel panel-default arrow-top-right">
                                <div class="panel-heading">
                                    More Apps
                                </div>
                                <div class="panel-body text-center">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-4"><a href="#" class="text-green"><span class="h2"><i class="fa fa-envelope-o"></i></span><p class="text-gray no-margn">Messages</p></a></div>
                                        <div class="col-xs-6 col-sm-4"><a href="#" class="text-purple"><span class="h2"><i class="fa fa-calendar-o"></i></span><p class="text-gray no-margn">Events</p></a></div>

                                        <div class="col-xs-12 visible-xs-block"><hr></div>

                                        <div class="col-xs-6 col-sm-4"><a href="#" class="text-red"><span class="h2"><i class="fa fa-comments-o"></i></span><p class="text-gray no-margn">Chatting</p></a></div>

                                        <div class="col-lg-12 col-md-12 col-sm-12  hidden-xs"><hr></div>

                                        <div class="col-xs-6 col-sm-4"><a href="#" class="text-yellow"><span class="h2"><i class="fa fa-folder-open-o"></i></span><p class="text-gray">Folders</p></a></div>

                                        <div class="col-xs-12 visible-xs-block"><hr></div>

                                        <div class="col-xs-6 col-sm-4"><a href="#" class="text-primary"><span class="h2"><i class="fa fa-flag-o"></i></span><p class="text-gray">Task</p></a></div>
                                        <div class="col-xs-6 col-sm-4"><a href="#" class="text-info"><span class="h2"><i class="fa fa-star-o"></i></span><p class="text-gray">Favorites</p></a></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </header>
                <!-- Header Ends -->
                {{--START CONTENT--}}
                <div class="container-fluid"  id="app">
                    @include('partials._breadcrumbs')
                    @yield('content')
                </div>
                {{--START FOOTER--}}
                <footer class="container-fluid footer visible-md visible-lg">
                    版权所有 &copy; 2014-{{date('Y')}} <a href="http://staraw.com/" target="_blank">青岛世达奥科网络技术</a>
                </footer>
            </section>
{{--START LAST PARTIAL--}}
@section('scripts')
    <script src="http://libs.useso.com/js/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://libs.useso.com/js/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="/js/plugin.js"></script>
    <script src="/js/main.js"></script>
@show
</body>
</html>
