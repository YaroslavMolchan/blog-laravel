<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width"/>
    <meta name="owner" content="yaroslav@molchan.me"/>
    <meta name="author" content="Jadson"/>
    <meta name="resourse-type" content="Document"/>
    <meta http-equiv="expires" content=""/>
    <meta name="robots" content="index,follow"/>
    <meta name="revisit-after" content="4 days"/>
    <!-- Latest compiled and minified CSS -->
    @section('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    @show
    <link rel="stylesheet" type="text/css" href="/css/clean-blog.css"/>
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic'>
    <link rel="stylesheet" type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'>
    <title>{{ $appName }}</title>
</head>
<body>
<nav class="navbar navbar-default navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-collapse"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span></button>
            <a class="navbar-brand" href="/" rel="nofollow">{{ $appName }}</a></div>
        <div id="nav-collapse" class="collapse navbar-collapse">
            <ul id="w1" class="nav navbar-nav navbar-right">
                <li><a href="/">Home</a></li>
                <li><a href="/categories">Categories</a></li>
                <li><a href="/tags">Tags</a></li>
                <li><a href="/subscribe">Follow</a></li>
                <li><a href="/contacts">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
<header class="intro-header" style="background-image: url('/images/bg.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                @if (isset($pageInfo))
                    <div class="post-heading">
                        <h1>{{ $pageTitle or $appName }}</h1>
                        <h2 class="subheading">{{ $pageDescription }}</h2>
                        <span class="meta">{{ $pageInfo }}</span>
                    </div>
                @else
                    <div class="site-heading">
                        <h1>{{ $pageTitle or $appName }}</h1>
                        <hr class="small">
                        <span class="subheading">{{ $pageDescription }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            @include('flash::message')

            @yield('content')
        </div>
    </div>
</div>

<hr>
<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <ul class="list-inline text-center">
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                </ul>
                <p class="copyright text-muted">Copyright © {{ $appName }} {!! date('Y') !!}</p>
            </div>
        </div>
    </div>
</footer>
</body>
@section('scripts')
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="/js/clean-blog.js"></script>
@show
</html>
