<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 8/16/2016
 * Time: 3:28 PM
 */?>
<footer style="background-image: url('/resources/assets/pic/footer/footer-bg.jpg')" class="footer footer-fixed">
    <div class="container">
        <div class="row pb-50 pb-md-40">
            <!-- widget footer-->
            <div class="col-md-4 col-sm-12 mb-sm-30">
                <div class="logo-soc clearfix">
                    <div class="footer-logo"><a href="index.html"><img src="/resources/assets/img/logo-footer.png" data-at2x="/resources/assets/img/logo-footer@2x.png" alt="vung chua travel"></a></div>
                    <!-- social-->
                    <div class="social-link dark"><a href="#" class="cws-social fa fa-twitter"></a><a href="https://www.facebook.com/vungchuatravel" class="cws-social fa fa-facebook"></a><a href="#" class="cws-social fa fa-google-plus"></a><a href="#" class="cws-social fa fa-linkedin"></a><a href="skype:dieuhanh.vungchuatravel?call" class="cws-social fa fa-skype"></a></div>
                    <!-- ! social-->
                </div>
            </div>
            <!-- ! widget footer-->
            <!-- widget footer-->
            <div class="col-md-4 col-sm-6 mb-sm-30">
                <div class="widget-footer">
                    <h4>Contact</h4>
                    <div class="twitter-footer align-left">
                        <p><span>{{ trans('common.headquarter') }}</span> {{ trans('common.headAddr') }}</p>
                        <p><span>{{ trans('common.branch') }}</span> {{ trans('common.branchAddr') }}</p>
                        <p><span>Tel:</span> (052)3 82 88 82 - Fax: (052)3 852 999</p>
                        <p><span>Hotline:</span> 0905 99 79 89</p>
                        <p><span>Email:</span><a href="mailto:vungchuatravel@gmail.com"> vungchuatravel@gmail.com</a></p>
                        <p><span>Hotline:</span> 0949 07 86 86 / 0905 99 79 89</p>
                    </div>
                </div>
            </div>
            <!-- end widget footer-->
            <!-- widget footer-->
            <div class="col-md-4 col-sm-6">
                <div class="widget-footer">
                    <h4>Tag cloud</h4>
                    <div class="widget-tags-wrap">
                        <a href="#" rel="tag" class="tag">Travel</a>
                        <a href="#" rel="tag" class="tag">Honeymoon</a>
                        <a href="#" rel="tag" class="tag">Hotel</a>
                        <a href="#" rel="tag" class="tag">Restaurant</a>
                        <a href="#" rel="tag" class="tag">Airplane Ticket</a>
                    </div>
                </div>
            </div>
            <!-- end widget footer-->
        </div>
    </div>
    <!-- copyright-->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <p>© Copyright 2016 <span>VungChuaTravel</span> &nbsp;&nbsp;|&nbsp;&nbsp; All Rights Reserved</p>
                </div>
                <div class="col-sm-6 text-right"><a href="{{ url('/') }}" class="footer-nav">Home</a><a href="{{ url('tour') }}" class="footer-nav">Tours</a><a href="{{ url('tour') }}" class="footer-nav">News</a><a href="{{ url('guide') }}" class="footer-nav">Guide</a><a href="{{ url('pages/contact') }}" class="footer-nav">Contact</a></div>
            </div>
        </div>
    </div>
    <!-- end copyright-->
    <!-- scroll top-->
</footer>
<div id="scroll-top"><i class="fa fa-angle-up"></i></div>
