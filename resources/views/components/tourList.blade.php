<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 8/30/2016
 * Time: 11:28 AM
 */
?>
<div class="content-body">
    <div class="container page">
        <h2 class="title-section mb-5"><span>Search</span> Tours</h2>
        <div class="search-hotels mb-40 pattern">
            <form action="">
                <div class="tours-container">
                    <div class="tours-box">
                        <div class="row">
                            <div class="col-md-6 clearfix">
                                <div class="widget-price-slider float-left">
                                    <div class="price_slider_wrapper">
                                        <div aria-disabled="false" class="price_slider price_slider_amount ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                            <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                            <a href="#!" class="ui-slider-handle ui-state-default ui-corner-all">
                                                <div style="" class="price_label">
                                                    <span class="from"></span>
                                                </div>
                                            </a>
                                            <a href="#!" class="ui-slider-handle ui-state-default ui-corner-all">
                                            <div style="" class="price_label">
                                                <span class="to"></span>
                                            </div>
                                            </a>
                                        </div>
                                        <div class="price_slider_amount addon">
                                            <input id="min_price" type="text" name="min_price" value="" data-min="0" placeholder="Min price" style="display: none;">
                                            <input id="max_price" type="text" name="max_price" value="" data-max="1000" placeholder="Max price" style="display: none;">
                                            {{--<input type="hidden" name="post_type" value="product">--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="rating">
                                    <p>rating</p>
                                    <input id="searchRate" name="searchRate" class="rating rating-loading" data-min="0" data-max="5" data-step="1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="tours-search">
                                    <div class="search-wrap">
                                        <input type="text" placeholder="Destination" class="form-control search-field">
                                        <i class="flaticon-suntour-map search-icon"></i>
                                    </div>
                                    <div class="button-search">Search</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            @if(isset($mdTourList))
                @foreach($mdTourList as $tour)
                    <div class="col-md-4">
                        <div class="recom-item">
                            <div class="recom-media"><a href="{{url('tour-detail/'.$tour->tourTxtLnk)}}">
                                    <div class="pic"><img src="{{$tour->imgTp =='R' ? $tour->imgUrl : url('/').$tour->imgUrl}}" data-at2x="{{$tour->imgTp =='R' ? substr($tour->imgUrl, 0, -4).'@2x'.substr($tour->imgUrl, -4, 4) : substr(url('/').$tour->imgUrl, 0, -4).'@2x'.substr(url('/').$tour->imgUrl, -4, 4)}}" alt="{{$tour->imgAlt}}"></div></a>
                                <div class="location"><i class="flaticon-suntour-map"></i> {{$tour->prvNm}}, {{$tour->ntnNm}}</div>
                            </div>
                            <!-- Recomended Content-->
                            <div class="recom-item-body"><a href="{{url('tour-detail/'.$tour->tourTxtLnk)}}">
                                    <h6 class="blog-title">{{$tour->tourTit}}</h6></a>
                                <div class="stars-perc"><span style="width:{{$tour->tourRate}}%"></span></div>
                                <div class="recom-price"><span class="font-2">{{$tour->tourPrc.' '.$tour->tourCurrUnt}}</span> {{$tour->tourLgt}}</div>
                                <p class="recom-content">{{$tour->tourShtCnt}}</p><a href="{{url('tour-detail/'.$tour->tourTxtLnk)}}" class="cws-button small alt">Book now</a>
                                <div class="action font-2">{{$tour->tourPrmPrc}}%</div>
                            </div>
                            <!-- Recomended Image-->
                        </div>
                    </div>
                    <!-- Recomended item-->
                @endforeach
            @endif
            @if(isset($mdTourListGroup))
                @foreach($mdTourListGroup as $tourGrp)
                    <div class="col-md-4">
                        <div class="recom-item">
                            <div class="recom-media"><a href="{{url('tour-detail/'.$tourGrp->tourTxtLnk)}}">
                                    <div class="pic"><img src="{{$tourGrp->imgTp =='R' ? $tourGrp->imgUrl : url('/').$tourGrp->imgUrl}}" data-at2x="{{$tourGrp->imgTp =='R' ? substr($tourGrp->imgUrl, 0, -4).'@2x'.substr($tourGrp->imgUrl, -4, 4) : substr(url('/').$tourGrp->imgUrl, 0, -4).'@2x'.substr(url('/').$tourGrp->imgUrl, -4, 4)}}" alt="{{$tourGrp->imgAlt}}"></div></a>
                                <div class="location"><i class="flaticon-suntour-map"></i> {{$tourGrp->prvNm}}, {{$tourGrp->ntnNm}}</div>
                            </div>
                            <!-- Recomended Content-->
                            <div class="recom-item-body"><a href="{{url('tour-detail/'.$tourGrp->tourTxtLnk)}}">
                                    <h6 class="blog-title">{{$tourGrp->tourTit}}</h6></a>
                                <div class="stars-perc"><span style="width:{{$tourGrp->tourRate}}%"></span></div>
                                <div class="recom-price"><span class="font-2">{{$tourGrp->tourPrc.' '.$tourGrp->tourCurrUnt}}</span> {{$tourGrp->tourLgt}}</div>
                                <p class="recom-content">{{$tourGrp->tourShtCnt}}</p><a href="{{url('tour-detail/'.$tourGrp->tourTxtLnk)}}" class="cws-button small alt">Book now</a>
                                <div class="action font-2">{{$tourGrp->tourPrmPrc}}%</div>
                            </div>
                            <!-- Recomended Image-->
                        </div>
                    </div>
                    <!-- Recomended item-->
                @endforeach
            @endif
        </div>
        <div class="row">
            <div class="col-md-12 mb-md-50" style="text-align: center">
                <!-- pagination-->
                @if(isset($mdTourList))
                    {{ $mdTourList->render() }}
                @elseif(isset($mdTourListGroup))
                    {{ $mdTourListGroup->render() }}
                @endif
            </div>
        </div>
    </div>
</div>
