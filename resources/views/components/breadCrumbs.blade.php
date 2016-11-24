<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 8/24/2016
 * Time: 4:50 PM
 */
?>
<!-- breadcrumbs start-->
<section style="background-image:url('/resources/assets/pic/breadcrumbs/bg-1.jpg');" class="breadcrumbs">
    <div class="container">
        <div class="text-left breadcrumbs-item">
            <a href="{{url('')}}">home</a>
            <i>/</i>
            @if(isset($mdBreadCrumb))
                @foreach($mdBreadCrumb as $brc)
                    @if(isset($brc->grp))
                        <a href="{{url($brc->grpLnk)}}">{{$brc->grp}}</a>
                        @if(isset($brc->pstGrpNm))
                            <i>/</i>
                            <a href="{{url($brc->grpLnk.'/'.$brc->pstGrpLnk)}}">{{$brc->pstGrpNm}}</a>
                            @if(isset($brc->pstTit))
                                <i>/</i>
                                @if($brc->grp == 'tours')
                                    <a href="{{url('tour-detail/'.$brc->pstLnk)}}">{{$brc->pstTit}}</a>
                                @elseif($brc->grp == 'news')
                                    <a href="{{url('news-detail/'.$brc->pstLnk)}}">{{$brc->pstTit}}</a>
                                @elseif($brc->grp == 'guide')
                                    <a href="{{url('guide-detail/'.$brc->pstLnk)}}">{{$brc->pstTit}}</a>
                                @endif
                                <h2><span>{{$brc->pstTit}} {{isset($postCount) ? '('.$postCount.')' : ""}}</span></h2>
                            @else
                                <h2><span>{{$brc->pstGrpNm}} {{isset($postCount) ? '('.$postCount.')' : ""}}</span></h2>
                            @endif
                        @elseif(isset($brc->pstTit))
                            @if($brc->grp == 'guide')
                                <i>/</i>
                                <a href="{{url('guide-detail/'.$brc->pstLnk)}}">{{$brc->pstTit}}</a>
                                <h2><span>{{$brc->pstTit}} {{isset($postCount) ? '('.$postCount.')' : ""}}</span></h2>
                            @endif
                        @else
                            <h2><span>{{$brc->grp}} {{isset($postCount) ? '('.$postCount.')' : ""}}</span></h2>
                        @endif
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- ! breadcrumbs end-->
