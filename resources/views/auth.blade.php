<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>易事达智慧办公--中油七建定制版</title>
    <link href="http://libs.useso.com/js/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://libs.useso.com/js/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href='http://fonts.useso.com/css?family=Raleway:400,500,600,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/vendor.css">
</head>
<body>
<!--[if lt IE 10]>
<p class="browserupgrade">您的浏览器已<strong>面临淘汰</strong>,到这里<a href="http://staraw.com/bye.html">升级靠谱浏览器</a>提升安全及体验。</p>
<![endif]-->
<div class="bg-img vertical-center">

    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>
                    <div class="panel-body">
                        @yield('form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--START LAST PARTIAL--}}
@section('scripts')
    <script src="http://libs.useso.com/js/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://libs.useso.com/js/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="/js/plugin.js"></script>
    <script src="/js/main.js"></script>
@show
</body>
</html>
