<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 8/16/2016
 * Time: 3:53 PM
 */?>
<!-- call out section-->
<section class="page-section pt-90 pb-80 bg-main pattern relative">
    <div class="container">
        <div class="call-out-box clearfix with-icon">
            <div class="row call-out-wrap">
                <div class="col-md-5">
                    <h6 class="title-section-top gray font-4">subscribe today</h6>
                    <h2 class="title-section alt-2"><span>Get</span> Latest offers</h2>
                    <i class="flaticon-suntour-email call-out-icon"></i>
                    {{--<i class="flaticon-suntour-email call-out-icon"></i>--}}
                </div>
                <div class="col-md-7">
                    <div class="email_server_response"></div>
                    <form id="email-sub-form" action="" method="POST" class="contact-form form mt-10">
                        <div class="input-container">
                            <input type="text" placeholder="Enter your email" value="" name="email" id="email" class="newsletter-field mb-0 form-row">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="GET">
                            <i class="flaticon-suntour-email icon-left"></i>
                            <button type="submit" class="subscribe-submit" id="email-submit">
                                <i class="flaticon-suntour-arrow icon-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ! call out section-->
