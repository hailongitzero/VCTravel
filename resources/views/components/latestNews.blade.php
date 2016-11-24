<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 8/16/2016
 * Time: 3:53 PM
 */
?>
<!-- latest news-->
<section class="small-section cws_prlx_section bg-blue-40"><img src="/resources/assets/img/World-Travel-Background.jpg" alt class="cws_prlx_layer">
    <div class="container">
        <div class="row mb-50 align-center">
            <div class="col-md-8 col-md-offset-2">
                <h6 class="title-section-top font-2">Latest News</h6>
                <h2 class="title-section alt-2"><span>Vung Chua Travel</span> News Magazine</h2>
                <div class="cws_divider mb-25 mt-5"></div>
                <p class="color-white">Vestibulum feugiat vitae tortor ut venenatis. Sed cursus, purus eu euismod bibendum, diam nisl suscipit odio, vitae ultrices mauris dolor quis mauris. Curabitur ac metus id leo maxim.</p>
            </div>
            {{--<div class="col-md-4"><i class="flaticon-suntour-calendar title-icon alt"></i></div>--}}
        </div>
        <div class="carousel-container">
            <div class="row">
                <div class="owl-two-pag pagiation-carousel mb-20">
                    @if(isset($latestNews))
                        @foreach($latestNews as $news)
                            <!-- Blog item-->
                            <div class="blog-item clearfix">
                                <!-- Blog Image-->
                                <div class="blog-media"><a href="blog-single.html">
                                        <div class="pic"><img src="{{$news->imgTp =='R' ? $news->imgUrl : url('/').$news->imgUrl}}" data-at2x="{{$news->imgTp =='R' ? substr($news->imgUrl, 0, -4).'@2x'.substr($news->imgUrl, -4, 4) : substr(url('/').$news->imgUrl, 0, -4).'@2x'.substr(url('/').$news->imgUrl, -4, 4)}}" alt="{{$news->imgAlt}}"></div></a></div>
                                <!-- blog body-->
                                <div class="blog-item-body clearfix">
                                    <!-- title--><a href="blog-single.html">
                                        <h6 class="blog-title">{{$news->nwsTit}}</h6></a>
                                    <div class="blog-item-data">
                                        {{$news->crtDt}}</div>
                                    <!-- Text Intro-->
                                    <p>{{$news->nwsShtCnt}}</p><a href="blog-single.html" class="blog-button">Read more</a>
                                </div>
                            </div>
                            <!-- ! Blog item-->
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ! latest news-->
