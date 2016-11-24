<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 8/16/2016
 * Time: 3:31 PM
 */
?>
<div class="tp-banner-container">
    <div class="tp-banner-slider">
        <ul>
            @if(isset($sliderContent))
                @foreach($sliderContent as $sldData)
                    {!! $sldData->sldHtmlCd !!}
                @endforeach
            @endif
        </ul>
    </div>
    <!-- slider info-->
    <div class="slider-info-wrap clearfix">
        <div class="slider-info-content">
            @if(isset($sliderPost))
                @foreach($sliderPost as $post)
                    <div class="slider-info-item">
                        <div class="info-item-media"><img src="{{$post->imgTp =='R' ? $post->imgUrl : url('/').$post->imgUrl}}" data-at2x="{{$post->imgTp =='R' ? substr($post->imgUrl, 0, -4).'@2x'.substr($post->imgUrl, -4, 4) : substr(url('/').$post->imgUrl, 0, -4).'@2x'.substr(url('/').$post->imgUrl, -4, 4)}}" alt = '{{$post->imgAlt}}'>
                            <div class="info-item-text">
                                <div class="info-price font-1"><span>{{$post->tourLgt}}</span> {{$post->tourPrc}} {{$post->tourCurrUnt}}</div>
                                {{--<div class="info-temp font-4"><span>local temperature</span> 36° / 96.8°</div>--}}
                                <p class="info-text">{{$post->tourTit}}</p>
                            </div>
                        </div>
                        <div class="info-item-content">
                            <div class="main-title">
                                <h3 class="title"><span class="font-2">{{$post->ntnNm}}</span> {{$post->prvNm}}</h3>
                                <div class="price"><span>{{$post->tourPrc}} {{$post->tourCurrUnt}}</span> {{$post->tourLgt}}</div><a href="{{url('tour-detail/'.$post->tourTxtLnk)}}" class="button">Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- ! slider-info-->
</div>
