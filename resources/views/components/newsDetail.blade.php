<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 9/9/2016
 * Time: 3:53 PM
 */
?>

<div class="container page">
    <div class="row">
        <div class="col-md-8 mb-md-140">
            @if(isset($mdNewsDetail))
                @foreach($mdNewsDetail as $detail)
                <!-- Blog Post image-->
                <div class="blog-item alt pb-20">
                    <div class="blog-item-data clearfix">
                        <h3 class="blog-title">{{$detail->newsTit}}</h3>
                        <p class="post-info"><i class="flaticon-suntour-calendar"></i> {{ $detail->crtDt }}</p>
                    </div>
                    {!! $detail->newsCnt !!}
                    <div class="blog-tags mb-40">
                        {{--<div class="blog-nav-tags"> <i class="flaticon-suntour-tag"></i><a href="blog-single.html#">Travel</a>, <a href="blog-single.html#">Beach</a>, <a href="blog-single.html#">Family</a></div>--}}
                        <div class="blog-nav-share align-right mt-lg-0"> <a href="#" class="cws-social fa fa-twitter"></a><a href="https://www.facebook.com/vungchuatravel" class="cws-social fa fa-facebook"></a><a href="#" class="cws-social fa fa-google-plus"></a><a href="#" class="cws-social fa fa-linkedin"></a></div>
                    </div>
                </div>
                @endforeach
            @endif
            <div class="blog-item alt">
                <h2 class="title-section alt-3 font-bold mt-0 mb-10">Comments <span>({{$mdNewsComment->total()}})</span></h2>
                <div class="cws_divider"></div>
                @if(isset($mdNewsComment))
                    @foreach($mdNewsComment as $comment)
                    <!-- comment list section-->
                    <div class="comments mt-40">
                        <div class="comment-body">
                            <div class="avatar"><img src="/resources/assets/img/dummy.png" data-at2x="/resources/assets/img/dummy@2x.png" alt></div>
                            <div class="comment-info">
                                <div class="comment-meta">
                                    <div class="title">
                                        <h5>{{ $comment->cmFName.' '.$comment->cmLName }}</h5>
                                    </div>
                                    <div class="comment-date"><span>{{ $comment->cmCrtDt }}</span></div>
                                </div>
                                <div class="comment-content">
                                    <p>{{ $comment->cmCnt }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ! comment list section-->
                    @endforeach
                @endif
            </div>
            <!-- Leave a comment-->
            <h2 class="title-section mt-50 mb-20"><span>Post a comment</span></h2>
            <div class="add-comment pattern bg-gray-3 relative">
                <div class="widget-contact-form pb-0">
                    <!-- contact-form-->
                    <div class="email_server_responce"></div>
                    <form action="php/contacts-process.htm" method="post" class="form contact-form alt clearfix">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-container">
                                    <input type="text" name="name" value="" size="40" placeholder="Name" aria-invalid="false" aria-required="true" class="form-row form-row-first">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-container">
                                    <input type="text" name="email" value="" size="40" placeholder="Email" aria-required="true" class="form-row form-row-last">
                                </div>
                            </div>
                        </div>
                        <div class="input-container">
                            <textarea name="message" cols="40" rows="4" placeholder="Comment" aria-invalid="false" aria-required="true"></textarea>
                        </div>
                        <input type="submit" value="Submit now" class="cws-button alt">
                    </form>
                    <!-- /contact-form-->
                </div>
            </div>
        </div>
        <div class="col-md-4 sidebar">
            <aside class="sb-right pb-50-imp">
                <!-- widget post-->
                <div class="cws-widget">
                    <div class="widget-post">
                        <h2 class="widget-title alt">Popular Posts</h2>
                        @if(isset($mdNewsPopular))
                            @foreach($mdNewsPopular as $popular)
                                <!-- item recent post-->
                                <div class="item-recent clearfix">
                                    <div class="widget-post-media"><img src="{{$popular->imgTp =='R' ? $popular->imgUrl : url('/').$popular->imgUrl}}" data-at2x="{{$popular->imgTp =='R' ? substr($popular->imgUrl, 0, -4).'@2x'.substr($popular->imgUrl, -4, 4) : substr(url('/').$popular->imgUrl, 0, -4).'@2x'.substr(url('/').$popular->imgUrl, -4, 4)}}" alt="{{$popular->imgAlt}}"></div>
                                    <h3 class="title"><a href="{{url('news-detail/'.$popular->newsTxtLnk)}}">{{$popular->newsTit}}</a></h3>
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