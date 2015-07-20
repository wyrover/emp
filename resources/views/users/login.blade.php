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
<body class="animated fadeInDown">
<!--[if lt IE 10]>
<p class="browserupgrade">您的浏览器已<strong>面临淘汰</strong>,到这里<a href="http://staraw.com/bye.html">升级靠谱浏览器</a>提升安全及体验。</p>
<![endif]-->
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <h3 class="text-center">Braio</h3>
            <p class="text-center">Sign in to get in touch</p>
            <hr class="clean">
            <form role="form">
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="email" class="form-control" placeholder="Email Adress">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label class="cr-styled">
                        <input type="checkbox" ng-model="todo.done">
                        <i class="fa"></i>
                    </label>
                    Remember me
                </div>
                <button type="submit" class="btn btn-purple btn-block">Sign in</button>
            </form>
            <hr>

            <p class="text-center text-gray">Dont have account yet!</p>
            <button type="submit" class="btn btn-default btn-block">Create Account</button>
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
