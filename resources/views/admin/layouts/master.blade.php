<!doctype html>
<html>
<head>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <!-- Bootstrap -->
    <link rel="stylesheet" href="/resources/assets/admin/css/bootstrap.min.css">
    <!-- Bootstrap responsive -->
    <link rel="stylesheet" href="/resources/assets/admin/css/bootstrap-responsive.min.css">
    <!-- Bootstrap switch -->
    <link rel="stylesheet" href="/resources/assets/admin/css/bootstrap-switch.min.css">
    <!-- Jquery UI -->
    <link rel="stylesheet" href="/resources/assets/admin/css/jquery-ui.min.css">
    <!-- small charts plugin -->
    <link rel="stylesheet" href="/resources/assets/admin/css/jquery.easy-pie-chart.css">
    <!-- calendar plugin -->
    <link rel="stylesheet" href="/resources/assets/admin/css/fullcalendar.css">
    <!-- Calendar printable -->
    <link rel="stylesheet" href="/resources/assets/admin/css/fullcalendar.print.css" media="print">
    <!-- chosen plugin -->
    <link rel="stylesheet" href="/resources/assets/admin/css/chosen.css">
    <!-- CSS for Growl like notifications -->
    <link rel="stylesheet" href="/resources/assets/admin/css/jquery.gritter.css">
    <!-- tagsinput plugin -->
    {{--<link rel="stylesheet" href="/resources/assets/admin/css/jquery.tagsinput.css">--}}
    <link rel="stylesheet" href="/resources/assets/admin/css/bootstrap-tagsinput.css">
    <!-- MultiUpload plupload plugin -->
    {{--<link rel="stylesheet" href="/resources/assets/admin/css/jquery.plupload.queue.css">--}}
    <link rel="stylesheet" href="/resources/assets/admin/css/jquery.ui.plupload.css">
    <!--custom css -->
    <link rel="stylesheet" href="/resources/assets/admin/css/site.css">
    <!-- Theme CSS -->
    <!--[if !IE]> -->
    <link rel="stylesheet" href="/resources/assets/admin/css/style.css">
    <!-- <![endif]-->
    <!--[if IE]>
    <link rel="stylesheet" href="/resources/assets/admin/css/style_ie.css">
    <![endif]-->

    <link rel="shortcut icon" href="/resources/assets/admin/img/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" href="/resources/assets/admin/img/apple-touch-icon-precomposed.png" />

</head>

<body data-layout="fixed">
@include('admin.components.main.topNav')

<div id="main">
    @include('admin.components.main.mainNav')
    @section('admin')
    @show
</div>
@include('admin.components.main.bottomNav')
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-38620714-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
</body>
<!-- jQuery -->
<script src="/resources/assets/admin/js/jquery.min.js"></script>
<script src="/resources/assets/admin/js/jquery-ui.min.js"></script>
<!-- jQuery -->
<script src="/resources/assets/admin/js/jquery.validate.min.js"></script>
<!-- smoother animations -->
<script src="/resources/assets/admin/js/jquery.easing.min.js"></script>
<!-- Bootstrap -->
<script src="/resources/assets/admin/js/bootstrap.min.js"></script>

<!-- small charts plugin -->
<script src="/resources/assets/admin/js/jquery.easy-pie-chart.min.js"></script>
<!-- Charts plugin -->
<script src="/resources/assets/admin/js/jquery.flot.min.js"></script>
<!-- Pie charts plugin -->
<script src="/resources/assets/admin/js/jquery.flot.pie.min.js"></script>
<!-- Bar charts plugin -->
<script src="/resources/assets/admin/js/jquery.flot.bar.order.min.js"></script>
<!-- Charts resizable plugin -->
<script src="/resources/assets/admin/js/jquery.flot.resize.min.js"></script>
<!-- calendar plugin -->
<script src="/resources/assets/admin/js/fullcalendar.min.js"></script>
<!-- chosen plugin -->
<script src="/resources/assets/admin/js/chosen.jquery.min.js"></script>
<!-- Scrollable navigation -->
<script src="/resources/assets/admin/js/jquery.nicescroll.min.js"></script>
<!-- Growl Like notifications -->
<script src="/resources/assets/admin/js/jquery.gritter.min.js"></script>
<!-- dataTables plugin -->
<script src="/resources/assets/admin/js/jquery.dataTables.min.js"></script>
<!-- TableTools for dataTables plguin -->
<script src="/resources/assets/admin/js/TableTools.min.js"></script>
<!-- Just for demonstration -->
<script src="/resources/assets/admin/js/demonstration.min.js"></script>
<!-- Theme framework -->
<script src="/resources/assets/admin/js/eakroko.min.js"></script>
<!-- CKEditor -->
<script src="/resources/assets/admin/js/ckeditor/ckeditor.js"></script>
<!-- multiUpload plupload plugin -->
<script src="/resources/assets/admin/js/plupload.full.min.js"></script>
<script src="/resources/assets/admin/js/jquery.ui.plupload.min.js"></script>
<!-- Theme scripts -->
<script src="/resources/assets/admin/js/application.min.js"></script>
<!-- tagsinput plugin -->
{{--<script src="/resources/assets/admin/js/jquery.tagsinput.min.js"></script>--}}
<script src="/resources/assets/admin/js/bootstrap-tagsinput.js"></script>
<!-- bootstrap switch -->
<script src="/resources/assets/admin/js/bootstrap-switch.min.js"></script>
<!-- site Script -->
<script src="/resources/assets/admin/js/site.js"></script>
<!-- site Script -->
<script src="/resources/assets/admin/js/formsubmit.js"></script>
<!-- file upload plugin -->
<script src="/resources/assets/admin/js/bootstrap-fileupload.min.js"></script>

<script src="/resources/assets/admin/js/formsubmit.js"></script>
</html>