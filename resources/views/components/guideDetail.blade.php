<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 9/15/2016
 * Time: 4:18 PM
 */
?>
<div class="container page">
    <div class="row">
        <div class="col-md-8 mb-md-140">
        @if(isset($mdGuideDetail))
            @foreach($mdGuideDetail as $detail)
                <!-- Blog Post image-->
                    <div class="blog-item alt pb-20">
                        <div class="blog-item-data clearfix">
                            <h3 class="blog-title">{{$detail->guideTit}}</h3>
                            <p class="post-info"><i class="flaticon-suntour-calendar"></i> {{ $detail->crtDt }}</p>
                        </div>
                        {!! $detail->guideCnt !!}
                        <div class="blog-tags mb-40">
                            {{--<div class="blog-nav-tags"> <i class="flaticon-suntour-tag"></i><a href="blog-single.html#">Travel</a>, <a href="blog-single.html#">Beach</a>, <a href="blog-single.html#">Family</a></div>--}}
                            <div class="blog-nav-share align-right mt-lg-0"> <a href="#" class="cws-social fa fa-twitter"></a><a href="https://www.facebook.com/vungchuatravel" class="cws-social fa fa-facebook"></a><a href="#" class="cws-social fa fa-google-plus"></a><a href="#" class="cws-social fa fa-linkedin"></a></div>
                        </div>
                    </div>
                @endforeach
            @endif
            <div id="reviews" class="mb-60">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="trans-uppercase mb-10">Reviews travellers</h4>
                        <div class="cws_divider mb-30"></div>
                    </div>
                </div>
                <div class="reviews-wrap">
                    <div class="reviews-top pattern relative">
                        @if(isset($mdGuideDetail))
                            @foreach($mdGuideDetail as $guideRate)
                                <div class="reviews-total">
                                    @if(($guideRate->guideRate)/20 <= 1)
                                        <h5>Terrible</h5>
                                    @elseif(($guideRate->guideRate)/20 <= 2)
                                        <h5>Bad</h5>
                                    @elseif(($guideRate->guideRate)/20 <= 3)
                                        <h5>Normal</h5>
                                    @elseif(($guideRate->guideRate)/20 <= 4)
                                        <h5>Good</h5>
                                    @elseif(($guideRate->guideRate)/20 <= 5)
                                        <h5>Excellent</h5>
                                    @endif
                                    <div class="reviews-sub-mark">{{($guideRate->guideRate)/20}}</div>
                                    <div class="stars-perc"><span style="width:{{$guideRate->guideRate}}%"></span></div><span>{{$guideRate->guideRateSeq}} reviews</span>
                                </div>
                                <div class="reviews-marks">
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="comments">
                        @if(isset($mdGuideComment))
                            @foreach($mdGuideComment as $guideCm)
                                <div class="comment-body">
                                    <div class="avatar"><img src="/resources/assets/img/dummy.png" data-at2x="/resources/assets/img/dummy.png" alt></div>
                                    <div class="comment-info">
                                        <div class="comment-meta">
                                            <div class="title">
                                                <h5>{{$guideCm->cmTit}} <span>{{$guideCm->cmLName.' '.$guideCm->cmFName}}</span></h5>
                                            </div>
                                            <div class="comment-date">
                                                <div class="stars stars-{{$guideCm->cmRate}}">{{$guideCm->cmRate}}</div><span>{{$guideCm->cmCrtDt}}</span>
                                            </div>
                                        </div>
                                        <div class="comment-content">
                                            <p>{{$guideCm->cmCnt}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="reviews-bottom">
                        <h4>You've been travel this tour?</h4>
                    </div>
                </div>
            </div>
            <h4 class="trans-uppercase mb-10">Write a review</h4>
            <div class="cws_divider mb-30"></div>
            <div class="review-content pattern relative">
                @if(isset($mdGuideDetail))
                    @foreach($mdGuideDetail as $guideVw)
                        <div class="row">
                            <div class="col-md-5 mb-md-30 mb-xs-0">
                                <div class="review-total"><img src="{{$guideVw->imgUrl}}" data-at2x="{{$guideVw->imgUrl}}" alt>
                                    <div class="review-total-content">
                                        <h6>{{$guideVw->guideTit}}</h6>
                                        <div class="stars stars-4"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="review-marks clearfix mb-30">
                                    <ul>
                                        <li>
                                            <label for="tourRate" class="control-label">Rate This</label>
                                            <input id="tourRate" name="tourRate" class="rating rating-loading" data-min="0" data-max="5" data-step="1">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <form class="form clearfix" action="{{url('commentSubmit')}}" method="post">
                            <div class="row">
                                <div class="col-md-4">
                                    <input id="rateValue" name="rateValue" type="hidden" value="" aria-required="true" required>
                                    <input type="hidden" id="tourID" name="tourID" value="{{$guideVw->guideId}}"  aria-required="true" required>
                                    <input type="text" id="firstName" name="firstName" value="" size="40" placeholder="First Name" aria-required="true" class="form-row form-row-first" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" id="lastName" name="lastName" value="" size="40" placeholder="Last Name" aria-required="true" class="form-row form-row-first" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="email" id="email" name="email" value="" size="40" placeholder="Email" aria-required="true" class="form-row form-row-first" required>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" id="title" name="title" value="" size="40" placeholder="Title of your review" required aria-required="true" class="form-row form-row-last">
                                </div>
                                <div class="col-md-12">
                                    <textarea name="content" id="content" cols="40" rows="4" placeholder="Message of your review" aria-invalid="false" required aria-required="true" class="mb-20"></textarea>
                                    <input type="submit" value="Add a review" class="cws-button alt float-right">
                                </div>
                            </div>
                        </form>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-4 sidebar">
            <aside class="sb-right pb-50-imp">
                <!-- widget post-->
                <div class="cws-widget">
                    <div class="widget-post">
                        <h2 class="widget-title alt">Popular Posts</h2>
                    @if(isset($mdPopularGuide))
                        @foreach($mdPopularGuide as $popular)
                            <!-- item recent post-->
                                <div class="item-recent clearfix">
                                    <div class="widget-post-media"><img src="{{$popular->imgTp =='R' ? $popular->imgUrl : url('/').$popular->imgUrl}}" data-at2x="{{$popular->imgTp =='R' ? substr($popular->imgUrl, 0, -4).'@2x'.substr($popular->imgUrl, -4, 4) : substr(url('/').$popular->imgUrl, 0, -4).'@2x'.substr(url('/').$popular->imgUrl, -4, 4)}}" alt="{{$popular->imgAlt}}"></div>
                                    <h3 class="title"><a href="{{url('news-detail/'.$popular->guideTxtLnk)}}">{{$popular->guideTit}}</a></h3>
                                    <div class="date-recent">{{$popular->crtDt}}</div>
                                </div>
                                <!-- ! item recent post-->
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- ! widget post-->
                <!-- widget tags-->
                <div class="cws-widget">
                    <div class="widget-tags">
                        <h2 class="widget-title">Tags</h2>
                        <!-- item tags-->
                        {{--<div class="widget-tags-wrap"><a href="#" rel="tag" class="tag">Adventure</a><a href="blog-single.html#" rel="tag" class="tag">Romantic</a><a href="blog-single.html#" rel="tag" class="tag">Wildlife</a><a href="blog-single.html#" rel="tag" class="tag">Beach</a><a href="blog-single.html#" rel="tag" class="tag">Honeymoon</a><a href="blog-single.html#" rel="tag" class="tag">Island</a><a href="blog-single.html#" rel="tag" class="tag">Parks</a><a href="blog-single.html#" rel="tag" class="tag">Family</a><a href="blog-single.html#" rel="tag" class="tag">Travel</a></div>--}}
                    </div>
                </div>
                <!-- ! widget tags-->
            </aside>
        </div>
    </div>
</div>
