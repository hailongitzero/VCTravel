<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 10/17/2016
 * Time: 1:20 PM
 */?>
        <!doctype html>
<html>
<head>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta names="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <!-- Bootstrap -->
    <link rel="stylesheet" href="/resources/assets/admin/css/bootstrap.min.css">
    <!-- Bootstrap responsive -->
    <link rel="stylesheet" href="/resources/assets/admin/css/bootstrap-responsive.min.css">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="/resources/assets/admin/css/site.css">
    <!--[if !IE]> -->
    <link rel="stylesheet" href="/resources/assets/admin/css/style.css">
    <!-- <![endif]-->
    <!--[if IE]>
    <link rel="stylesheet" href="/resources/assets/admin/css/style_ie.css">
    <![endif]-->

    <!-- jQuery -->
    <script src="/resources/assets/admin/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/resources/assets/admin/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script src="/resources/assets/admin/js/jquery.validate.min.js"></script>

    <!-- Bootstrap -->
    <script src="/resources/assets/admin/js/formsubmit.js"></script>

    <!-- Just for demonstration -->
    <script src="/resources/assets/admin/js/demonstration.min.js"></script>
    <!-- Theme scripts -->
    <script src="/resources/assets/admin/js/application.min.js"></script>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png" />

</head>
<body class='login-body'>
<div class="login-wrap">
    <h2>ease</h2>
    <div class="login" id="login">
        <form id="login-form" action=" " method="POST">
            <a href="ease.html#" class='button button-basic-blue button-less-round'>Connect with <span>Facebook</span></a>
            <a href="ease.html#" class='button button-basic-blue button-less-round button-twitter'>Connect with <span>Twitter</span></a>
            <div class="sep">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="GET">
            </div>
            <div class="user">
                <input type="text" name="username" id="username" placeholder="Username" class='input-block-level'>
            </div>
            <div class="pw">
                <input type="password" name="password" id="password" placeholder="Password" class='input-block-level'>
            </div>
            <div class="checkbox">
                <input type="checkbox" name="remember" id="remember" value="1"><p class="remember">Ghi nhớ</p>
            </div>
            <div class="form-response">
            </div>
            <button type="submit" value="Sign In" class='button button-basic-darkblue btn-block'>Đăng Nhập</button>
        </form>
    </div>
    <a href="ease.html#" class='pw-link'>Forgot your <span>password</span>? <i class="icon-arrow-right"></i></a>
</div>
<script type="text/javascript">

//    var _gaq = _gaq || [];
//    _gaq.push(['_setAccount', 'UA-38620714-1']);
//    _gaq.push(['_trackPageview']);
//
//    (function() {
//        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
//        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
//        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
//    })();

</script>
</body>

</html>
