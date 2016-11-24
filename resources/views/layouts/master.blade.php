<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 18/07/2016
 * Time: 21:29
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

    <meta charset="utf-8">

    <title>@yield('title')</title> <!--insert your title here-->
    <meta name="title" content="@yield('meta-title')"> <!--insert your title here-->
    <meta name="description" content="@yield('description')"> <!--insert your description here-->
    <meta name="keywords" content="@yield('keywords')"> <!--insert your keywords here-->
    <meta name="author" content="@yield('author')"> <!--insert your name here-->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0"> <!--meta responsive-->

    <!--START CSS-->
    <link rel="stylesheet" href="/resources/assets/css/reset.css">
    <link rel="stylesheet" href="/resources/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/resources/assets/css/font-awesome.css">
    <link rel="stylesheet" href="/resources/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="/resources/assets/css/jquery.fancybox.css">
    <link rel="stylesheet" href="/resources/assets/fonts/fi/flaticon.css">
    <link rel="stylesheet" href="/resources/assets/css/flexslider.css">
    <link rel="stylesheet" href="/resources/assets/css/main.css">
    <link rel="stylesheet" href="/resources/assets/css/indent.css">
    <link rel="stylesheet" href="/resources/assets/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="/resources/assets/rs-plugin/css/layers.css">
    <link rel="stylesheet" href="/resources/assets/rs-plugin/css/navigation.css">
    <link rel="stylesheet" href="/resources/assets/tuner/css/colorpicker.css">
    <link rel="stylesheet" href="/resources/assets/css/star-rating.css">
    <link rel="stylesheet" href="/resources/assets/themes/krajee-fa/theme.css">
    <link rel="stylesheet" href="/resources/assets/tuner/css/styles.css">
    <link rel="stylesheet" href="/resources/assets/css/site.css">
    <!--END CSS-->


    <!--[if lt IE 9]>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>
<!-- header page-->
@include('components.header', $headerData)
<!-- ! header page-->
<div class="content-body">
    <!-- ! page content section-->
    @section('page-content')
    @show
</div>
<!-- footer-->
@include('components.footer')

@section('extend-component')
<script src="https://www.youtube.com/player_api"></script>
<script type="text/javascript" src="/resources/assets/js/jquery-3.1.0.js"></script>
<script type="text/javascript" src="/resources/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/resources/assets/js/bootstrap.js"></script>
<script type="text/javascript" src="/resources/assets/js/owl.carousel.js"></script>
<script type="text/javascript" src="/resources/assets/js/jquery.sticky.js"></script>
<script type="text/javascript" src="/resources/assets/js/TweenMax.min.js"></script>
<script type="text/javascript" src="/resources/assets/js/cws_parallax.js"></script>
<script type="text/javascript" src="/resources/assets/js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="/resources/assets/js/jquery.fancybox-media.js"></script>
<script type="text/javascript" src="/resources/assets/js/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="/resources/assets/js/imagesloaded.pkgd.min.js"></script>
<script type="text/javascript" src="/resources/assets/js/masonry.pkgd.min.js"></script>
<script type="text/javascript" src="/resources/assets/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="/resources/assets/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="/resources/assets/rs-plugin/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="/resources/assets/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="/resources/assets/rs-plugin/js/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="/resources/assets/rs-plugin/js/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="/resources/assets/rs-plugin/js/extensions/revolution.extension.video.min.js"></script>
<script type="text/javascript" src="/resources/assets/rs-plugin/js/extensions/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="/resources/assets/rs-plugin/js/extensions/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="/resources/assets/rs-plugin/js/extensions/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="/resources/assets/js/jquery.validate.js"></script>
<script type="text/javascript" src="/resources/assets/js/jquery.form.min.js"></script>
<script type="text/javascript" src="/resources/assets/js/script.js"></script>
<script type="text/javascript" src="/resources/assets/js/bg-video/cws_self_vimeo_bg.js"></script>
<script type="text/javascript" src="/resources/assets/js/bg-video/jquery.vimeo.api.min.js"></script>
<script type="text/javascript" src="/resources/assets/js/bg-video/cws_YT_bg.js"></script>
{{--<script type="text/javascript" src="/resources/assets/js/jquery.tweet.js"></script>--}}
<script type="text/javascript" src="/resources/assets/js/jquery.scrollTo.min.js"></script>
<script type="text/javascript" src="/resources/assets/js/jquery.flexslider.js"></script>
{{--<script type="text/javascript" src="/resources/assets/tuner/js/colorpicker.js"></script>--}}
{{--<script type="text/javascript" src="/resources/assets/tuner/js/scripts.js"></script>--}}
{{--<script type="text/javascript" src="/resources/assets/js/retina.min.js"></script>--}}
<script type="text/javascript" src="/resources/assets/js/star-rating.js"></script>
<script type="text/javascript" src="/resources/assets/themes/krajee-fa/theme.js"></script>
<script type="text/javascript" src="/resources/assets/js/site.js"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>