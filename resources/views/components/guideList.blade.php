<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 9/9/2016
 * Time: 2:02 PM
 */
?>
<div class="content-body">
    <div class="container page">
        <div class="row">
            @if(isset($mdGuideList))
                @foreach($mdGuideList as $list)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <!-- portfolio item-->
                        <div class="portfolio-item alt text-center">
                            <!-- media-->
                            <div class="pic"><a href="{{url('guide-detail/'.$list->guideTxtLnk)}}"><img src="{{$list->imgTp =='R' ? $list->imgUrl : url('/').$list->imgUrl}}" data-at2x="{{$list->imgTp =='R' ? substr($list->imgUrl, 0, -4).'@2x'.substr($list->imgUrl, -4, 4) : substr(url('/').$list->imgUrl, 0, -4).'@2x'.substr(url('/').$list->imgUrl, -4, 4)}}" alt></a>
                                <div class="hover-effect"></div>
                                <!-- item content--><a href="{{url('guide-detail/'.$list->guideTxtLnk)}}">
                                    <h3 class="portfolio-title">{{ $list->guideTit }}</h3>
                                    <div class="item-content">
                                        <p>{{ $list->guideShrCnt }}</p>
                                    </div></a>
                                <div class="links"><a href="{{$list->imgTp =='R' ? $list->imgUrl : url('/').$list->imgUrl}}" class="fancy"><i class="fa fa-expand"></i></a></div>
                            </div>
                        </div>
                        <!-- ! portfolio item-->
                    </div>
                @endforeach
            @endif
        </div>
        <!-- pagination-->
        <div class="row mt-20">
            <nav class="text-center">
                @if(isset($mdGuideList))
                    {{ $mdGuideList->render() }}
                @endif
            </nav>
        </div>
        <!-- ! pagination-->
    </div>
</div>