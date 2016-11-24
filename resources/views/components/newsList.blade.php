<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 9/9/2016
 * Time: 10:52 AM
 */

?>
<div class="content-body">
    <div class="container page">
        <div class="search-hotels mb-40 pattern1">
            <form action="">
                <div class="tours-container">
                    <div class="tours-box">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="tours-search">
                                    <div class="search-wrap">
                                        <input type="text" placeholder="Search Content" class="form-control search-field">
                                        <i class="flaticon-suntour-search search-icon"></i>
                                    </div>
                                    <div class="button-search">Search</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @if(isset($mdNewsList))
            @foreach($mdNewsList as $mdNews)
                @foreach($mdNews['newsGroup'] as $news)
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="title-section-top font-4">Top news</h6>
                            <h2 class="title-section"><span><a href="{{url('news/'.$news->grpLink)}}">{{$news->grpNm}}</a></span></h2>
                            <div class="cws_divider mb-25 mt-5"></div>
                            <p>{{$news->grpIntro}}</p>
                        </div>
                        <div class="col-md-4"><i class="flaticon-suntour-hotel title-icon"></i></div>
                    </div>
                    <div class="row">
                @endforeach
                @foreach($mdNews['newsList'] as $news)
                    <!-- Blog Post-->
                        <div class="col-lg-4 mb-30">
                            <!-- Blog item-->
                            <div class="blog-item clearfix border">
                                <!-- Blog Image-->
                                <div class="blog-media"><a href="{{url('news-detail/'.$news->newsTxtLnk)}}">
                                        <div class="pic"><img src="{{$news->imgTp =='R' ? $news->imgUrl : url('/').$news->imgUrl}}" data-at2x="{{$news->imgTp =='R' ? substr($news->imgUrl, 0, -4).'@2x'.substr($news->imgUrl, -4, 4) : substr(url('/').$news->imgUrl, 0, -4).'@2x'.substr(url('/').$news->imgUrl, -4, 4)}}" alt="{{$news->imgAlt}}">
                                        </div></a>
                                </div>
                                <!-- blog body-->
                                <div class="blog-item-body clearfix">
                                    <!-- title--><a href="{{url('news-detail/'.$news->newsTxtLnk)}}">
                                        <h6 class="blog-title">{{$news->newsTit}}</h6></a>
                                    <div class="blog-item-data">{{$news->crtDt}}</div>
                                    <!-- Text Intro-->
                                    <p>{{$news->newsShrCnt}}</p>
                                </div>
                            </div>
                            <!-- ! Blog item-->
                        </div>
                @endforeach
                </div>
            @endforeach
        @endif

        @if(isset($mdNewsListGroup))
            <div class="row">
                <div class="col-md-8">
                    <h6 class="title-section-top font-4">Top News</h6>
                    <h2 class="title-section"><span>Recommended</span> Tours</h2>
                    <div class="cws_divider mb-25 mt-5"></div>
                    <p>Maecenas commodo odio ut vulputate cursus. Integer in egestas lectus. Nam volutpat feugiat mi vitae mollis. Aenean tristique dolor bibendum mi scelerisque ultrices non at lorem.</p>
                </div>
                <div class="col-md-4"><i class="flaticon-suntour-hotel title-icon"></i></div>
            </div>
            <div class="row">
            @foreach($mdNewsListGroup as $newsGrp)
                <!-- Blog Post-->
                <div class="col-lg-4 mb-30">
                    <!-- Blog item-->
                    <div class="blog-item clearfix border">
                        <!-- Blog Image-->
                        <div class="blog-media"><a href="{{url('news-detail/'.$newsGrp->newsTxtLnk)}}">
                                <div class="pic"><img src="{{$newsGrp->imgTp =='R' ? $newsGrp->imgUrl : url('/').$newsGrp->imgUrl}}" data-at2x="{{$newsGrp->imgTp =='R' ? substr($newsGrp->imgUrl, 0, -4).'@2x'.substr($newsGrp->imgUrl, -4, 4) : substr(url('/').$newsGrp->imgUrl, 0, -4).'@2x'.substr(url('/').$newsGrp->imgUrl, -4, 4)}}" alt="{{$newsGrp->imgAlt}}"></div></a></div>
                        <!-- blog body-->
                        <div class="blog-item-body clearfix">
                            <!-- title--><a href="{{url('news-detail/'.$newsGrp->newsTxtLnk)}}">
                                <h6 class="blog-title">{{$newsGrp->newsTit}}</h6></a>
                            <div class="blog-item-data">{{$newsGrp->crtDt}}</div>
                            <!-- Text Intro-->
                            <p>{{$newsGrp->newsShrCnt}}</p>
                        </div>
                    </div>
                    <!-- ! Blog item-->
                </div>
            @endforeach
            </div>
            <div class="row">
                <div class="col-md-12 mb-md-50" style="text-align: center">
                    <!-- pagination-->
                    @if(isset($mdNewsListGroup))
                        {{ $mdNewsListGroup->render() }}
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
