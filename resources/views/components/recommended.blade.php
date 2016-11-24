<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 8/16/2016
 * Time: 3:50 PM
 */
?>
<!-- recomended section-->
<section class="small-section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h6 class="title-section-top font-4">Top rated</h6>
                <h2 class="title-section"><span>Recommended</span> Tours</h2>
                <div class="cws_divider mb-25 mt-5"></div>
                <p>Maecenas commodo odio ut vulputate cursus. Integer in egestas lectus. Nam volutpat feugiat mi vitae mollis. Aenean tristique dolor bibendum mi scelerisque ultrices non at lorem.</p>
            </div>
            <div class="col-md-4"><i class="flaticon-suntour-hotel title-icon"></i></div>
        </div>
        <div class="row">
            <!-- Recommended item-->
            @if(isset($mdTourRecommended))
                @foreach($mdTourRecommended as $tourRcm)
                    <div class="col-md-4">
                        <div class="recom-item">
                            <div class="recom-media"><a href="{{url('tour-detail/'.$tourRcm->tourTxtLnk)}}">
                                    <div class="pic"><img src="{{$tourRcm->imgTp =='R' ? $tourRcm->imgUrl : url('/').$tourRcm->imgUrl}}" data-at2x="{{$tourRcm->imgTp =='R' ? substr($tourRcm->imgUrl, 0, -4).'@2x'.substr($tourRcm->imgUrl, -4, 4) : substr(url('/').$tourRcm->imgUrl, 0, -4).'@2x'.substr(url('/').$tourRcm->imgUrl, -4, 4)}}" alt="{{$tourRcm->imgAlt}}"></div></a>
                                <div class="location"><i class="flaticon-suntour-map"></i> {{$tourRcm->prvNm}}, {{$tourRcm->ntnNm}}</div>
                            </div>
                            <!-- Recomended Content-->
                            <div class="recom-item-body"><a href="{{url('tour-detail/'.$tourRcm->tourTxtLnk)}}">
                                    <h6 class="blog-title">{{$tourRcm->tourTit}}</h6></a>
                                <div class="stars-perc"><span style="width:{{$tourRcm->tourRate}}%"></span></div>
                                <div class="recom-price"><span class="font-2">{{$tourRcm->tourPrc.' '.$tourRcm->tourCurrUnt}}</span> {{$tourRcm->tourLgt}}</div>
                                <p class="recom-content">{{$tourRcm->tourShtCnt}}</p><a href="{{url('tour-detail/'.$tourRcm->tourTxtLnk)}}" class="cws-button small alt">Book now</a>
                                <div class="action font-2">{{$tourRcm->tourPrmPrc}}%</div>
                            </div>
                            <!-- Recomended Image-->
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- ! recomended section-->
