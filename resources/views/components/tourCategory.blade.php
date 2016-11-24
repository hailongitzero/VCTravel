<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 8/16/2016
 * Time: 3:45 PM
 */
?>
<!-- page section destination-->
<section class="page-section pb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h6 class="title-section-top font-4">Special offers</h6>
                <h2 class="title-section"><span>Tours</span> Category</h2>
                <div class="cws_divider mb-25 mt-5"></div>
                <p>Nullam ac dolor id nulla finibus pharetra. Sed sed placerat mauris. Pellentesque lacinia imperdiet interdum. Ut nec nulla in purus consequat lobortis. Mauris lobortis a nibh sed convallis.</p>
            </div>
            <div class="col-md-4"><img src="/resources/assets/pic/promo-1.png" data-at2x="/resources/assets/pic/promo-1@2x.png" alt class="mt-md-0 mt-minus-70"></div>
        </div>
    </div>
    <div class="container features-tours-full-width">
        <div class="features-tours-wrap clearfix">
                @if(isset($rpvCate))
                    @foreach($rpvCate as $cate)
                            <div class="features-tours-item">
                                <div class="features-media"><img src="{{$cate->imgTp =='R' ? $cate->imgUrl : url('/').$cate->imgUrl}}" data-at2x="{{$cate->imgTp =='R' ? substr($cate->imgUrl, 0, -4).'@2x'.substr($cate->imgUrl, -4, 4) : substr(url('/').$cate->imgUrl, 0, -4).'@2x'.substr(url('/').$cate->imgUrl, -4, 4)}}" alt>
                                    <div class="features-info-top">
                                        <div class="info-price font-4"><span>Total</span> {{$cate->pstTot}} tours</div>
                                        <p class="info-text">{{$cate->pstIntro}}</p>
                                    </div>
                                    <div class="features-info-bot">
                                        <h4 class="title">
                                            {{$cate->pstNm}}
                                        </h4>
                                        <a href="{{url('tours/'.$cate->pstLnk)}}" class="button">Details</a>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                @endif
        </div>
    </div>
</section>
<!-- ! page section-->
