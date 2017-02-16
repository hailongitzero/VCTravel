<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 8/16/2016
 * Time: 3:21 PM
 */
?>
<header>
    <!-- site top panel-->
    <div class="site-top-panel">
        <div class="container p-relative">
            <div class="row">
                <div class="col-md-6 col-sm-7">
                    <!-- lang select wrapper-->
                    <div class="top-left-wrap font-3">
                        <div class="mail-top"><a href="mailto:vungchuatravel@gmail.com"> <i class="flaticon-suntour-email"></i>vungchuatravel@gmail.com</a></div><span>/</span>
                        <div class="tel-top"><a href="tel:(052)-382-88-82"> <i class="flaticon-suntour-phone"></i>(052)-382-88-82</a></div>
                    </div>
                    <!-- ! lang select wrapper-->
                </div>
                <div class="col-md-6 col-sm-5 text-right">
                    <div class="top-right-wrap">
                        <div class="lang-wrap dropdown">
                            <div>
                                <ul>
                                    <li><a href="#" class="lang-sel icl-en">{{trans('header.language')}} <i class="fa fa-angle-down"></i></a>
                                        <ul class="lang">
                                            <li><a href="{{url('lang/en')}}" class="en">English</a></li>
                                            <li> <a href="{{url('lang/vi')}}" class="vi">Vietnam</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ! site top panel-->
    <!-- Navigation panel-->
    <nav class="main-nav js-stick">
        <div class="full-wrapper relative clearfix container">
            <!-- Logo ( * your text or image into link tag *)-->
            <div class="nav-logo-wrap local-scroll"><a href="{{url('/')}}" class="logo"><img src="/resources/assets/img/vungchua-logo.png" data-at2x="/resources/assets/img/vungchua-logo@2x.png" alt></a></div>
            <!-- Main Menu-->
            <div class="inner-nav desktop-nav">
                <ul class="clearlist">
                    <!-- Item With Sub-->
                    @if(isset($menuData))
                        @foreach($menuData as $mnData)
                            @if($mnData->mnLvl == 0)
                                @if($mnData->mnDspTp == 'G')
                                    <li class="megamenu">
                                        <a href="{{ url($mnData->mnLnk) }}" class="mn-has-sub active">{{$mnData->mnNm }} <i class="fa fa-angle-down button_open"></i></a>
                                        <ul class="mn-sub mn-has-multi">
                                            @foreach($menuData as $mnFirstChild)
                                                @if($mnFirstChild->mnLvl == 1 && $mnFirstChild->mnPrtId == $mnData->mnId)
                                                    <li class="mn-sub-multi"><a class="mn-group-title">{{$mnFirstChild->mnNm}}</a>
                                                        <ul>
                                                            @foreach($menuData as $mnSecondChild)
                                                                @if($mnSecondChild->mnLvl == 2 && $mnSecondChild->mnPrtId == $mnFirstChild->mnId)
                                                                    <li><a href="{{ ($mnSecondChild->mnDspTp == 'P' ? url('pages'): url($mnData->mnLnk)).'/'.$mnSecondChild->mnLnk }}">{{$mnSecondChild->mnNm}}</a></li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ url($mnData->mnLnk) }}" class="mn-has-sub active">{{$mnData->mnNm }} <i class="fa fa-angle-down button_open"></i></a>
                                        <ul class="mn-sub">
                                            @foreach($menuData as $mnFirstChild)
                                                @if($mnFirstChild->mnLvl == 1 && $mnFirstChild->mnPrtId == $mnData->mnId)
                                                    <li><a href="{{url($mnData->mnLnk.'/'.$mnFirstChild->mnLnk)}}">{{$mnFirstChild->mnNm}}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                                @if($mnData->mnSeq < $menuInitData['mnMaxSeq'])
                                    <li class="slash">/</li>
                                @endif
                            @endif
                        @endforeach
                    @endif
                    {{--<!-- Search-->--}}
                    <li class="search"><a href="{{url('#')}}" class="mn-has-sub">{{trans('common.search')}}</a>
                        <ul class="search-sub">
                            <li>
                                <div class="container">
                                    <div class="mn-wrap">
                                        <form id="searchForm" method="post" class="form" action="search">
                                            <div class="search-wrap">
                                                <input id="txtSearch" name="txtSearch" type="text" placeholder="Where will you go next?" class="form-control search-field"><i class="flaticon-suntour-search search-icon"></i>
                                            </div>
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="POST">
                                        </form>
                                    </div>
                                    <div class="close-button"><span>{{ trans('common.search') }}</span></div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- End Search-->
                </ul>
            </div>
            <!-- End Main Menu-->
        </div>
    </nav>
    <!-- End Navigation panel-->
</header>
