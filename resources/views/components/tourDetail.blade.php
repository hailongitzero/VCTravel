<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 8/24/2016
 * Time: 4:51 PM
 */
?>
<section class="page-section pt-0 pb-50">
    <div class="container">
        <div class="menu-widget with-switch mt-30 mb-30">
            <ul class="magic-line">
                @if(isset($mdTourDetail))
                    @foreach($mdTourDetail as $tourHd)
                        <li class="current_item"><a href="hotels-details.html#overview" class="scrollto">Overview</a></li>
                        <li><a href="hotels-details.html#reviews" class="scrollto">Reviews ({{$tourHd->tourRateSeq}}) <div class="stars-perc"><span style="width:{{$tourHd->tourRate}}%"></span></div></a></li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    <div class="container">
       <div class="row">
           <div class="col-md-8">
               <div id="flex-slider" class="flexslider">
                   <ul class="slides">
                       @if(isset($mdTourDetailImage))
                           @foreach($mdTourDetailImage as $img)
                               <li><img src="{{$img->imgTp =='R' ? $img->imgUrl : url('/').$img->imgUrl}}" alt="{{$img->imgAlt}}"></li>
                           @endforeach
                       @endif
                   </ul>
               </div>
               <div id="flex-carousel" class="flexslider">
                   <ul class="slides">
                       @if(isset($mdTourDetailImage))
                           @foreach($mdTourDetailImage as $img)
                               <li><img src="{{$img->imgTp =='R' ? $img->imgUrl : url('/').$img->imgUrl}}" alt="{{$img->imgAlt}}" data-at2x="{{$img->imgTp =='R' ? substr($img->imgUrl, 0, -4).'@2x'.substr($img->imgUrl, -4, 4) : substr(url('/').$img->imgUrl, 0, -4).'@2x'.substr(url('/').$img->imgUrl, -4, 4)}}" alt="{{$img->imgAlt}}"></li>
                           @endforeach
                       @endif
                   </ul>
               </div>
           </div>
           <div class="col-md-4">
               <div class="fb-comments" data-href="" data-width="100%" data-numposts="5"></div>
           </div>
       </div>
    </div>
    <div class="container mt-30">
        @if(isset($mdTourDetail))
            @foreach($mdTourDetail as $tour)
                <h4 class="mb-20">{{$tour->tourTit}}</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="tabs">
                            <div class="block-tabs-btn clearfix">
                                <div data-tabs-id="tabs1" class="tabs-btn active">Tour Content</div>
                                <div data-tabs-id="tabs2" class="tabs-btn">Schedule Detail</div>
                            </div>
                            <!-- tabs keeper-->
                            <div class="tabs-keeper">
                                <div data-tabs-id="cont-tabs1" class="container-tabs active">
                                    {!! $tour->tourCnt !!}
                                </div>
                                <div data-tabs-id="cont-tabs2" class="container-tabs">
                                    {!! $tour->tourSchedule !!}
                                </div>
                            </div>
                            <!-- /tabs keeper-->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-info p-30-40">
                            <table class="table alt table-info">
                                <tbody>
                                <tr>
                                    <td width="50%">Price</td>
                                    <td><span class="price">{{$tour->tourPrc.' '.$tour->tourCurrUnt}}</span></td>
                                </tr>
                                <tr>
                                    <td>Length</td>
                                    <td>{{$tour->tourLgt}}</td>
                                </tr>
                                <tr>
                                    <td>Promotion</td>
                                    <td><span class="prm">{{$tour->tourPrmPrc.' %'}}</span></td>
                                </tr>
                                <tr>
                                    <td>Price after Promotion</td>
                                    <td><span class="price">{{$tour->tourFnlPrc.' '.$tour->tourCurrUnt}}</span></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="btn-cover-layout">
                                <a id="tour-booking" href="#!" class="cws-button small alt mb-20">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- login popup-->
    <div id="tour-popup" class="tour-popup">
        <div class="tour-popup-wrap">
            <div class="container-fluid">
            @if(isset($mdTourDetail))
                @foreach($mdTourDetail as $tour)
                    <div class="title-wrap">
                        <h2>Booking</h2><i class="close-button flaticon-close"></i>
                    </div>
                    <div class="row">
                        <div class="tour-content">
                            <form class="form booking-form" id="tour-booking-form" action="{{url('/tourBooking')}}" method="POST">
                                <div id="feedback-form-success" class="booking_server_response"></div>
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="POST">
                                <input type="hidden" id="tourID" name="tourID" value="{{$tour->tourId}}">
                                <div class="col col-md-6 col-sm12">
                                    <input type="text" id="custName" name="custName" value="" size="50" placeholder="Nhập họ tên ..." aria-required="true" class="form-row">
                                </div>
                                <div class="col col-md-6 col-sm12">
                                    <input type="tel" id="custPhone" name="custPhone" value="" size="15" placeholder="Enter Your Phone Number ..." aria-required="true" class="form-row">
                                    </div>
                                <div class="col col-md-6 col-sm12">
                                    <input type="email" id="custEmail" name="custEmail" value="" size="40" placeholder="Enter Your Email ..." aria-required="true" class="form-row">
                                </div>
                                <div class="col col-md-6 col-sm12">
                                    <i class="flaticon-suntour-adult box-icon"></i>
                                    <select id="adultQty" name="adultQty">
                                        <option value="0">Adult</option>
                                        <option value="1"> 1-2 </option>
                                        <option value="2"> 3-5 </option>
                                        <option value="3"> 6-10 </option>
                                        <option value="4"> 11-20 </option>
                                        <option value="5"> >20 </option>
                                    </select>
                                    <i class="flaticon-suntour-children box-icon"></i>
                                    <select id="childQty" name="childQty">
                                        <option value="0">Child</option>
                                        <option value="1"> 1-2 </option>
                                        <option value="2"> 3-5 </option>
                                        <option value="3"> 6-10 </option>
                                        <option value="4"> 11-20 </option>
                                        <option value="5"> >20 </option>
                                    </select>
                                </div>
                                <div class="col col-md-12 col-sm12">
                                    <input type="text" id="custAddress" name="custAddress" value="" size="150" placeholder="Enter Your Address ..." aria-required="true" class="form-row-full">
                                </div>
                                <div class="col col-md-6 col-sm12">
                                    <div class="tours-calendar divider-skew">
                                        <input id="departDate" name="departDate" placeholder="Depart date" type="text" value="" onfocus="(this.type='date')" onblur="(this.type='text')" class="calendar-default textbox-n"><i class="flaticon-suntour-calendar box-icon"></i>
                                    </div>
                                </div>
                                <div class="col col-md-6 col-sm12">
                                    <div class="tours-calendar divider-skew">
                                        <input id="returnDate" name="returnDate" placeholder="Return date" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="calendar-default textbox-n"><i class="flaticon-suntour-calendar box-icon"></i>
                                    </div>
                                </div>
                                <div class="col col-md-12 col-sm12">
                                    <textarea id="custContent" name="custContent" class="form-row" placeholder="Content.."></textarea>
                                </div>
                                <a href="#!" id="tourBookingBtn" class="cws-button gray alt full-width mt-20">Booking</a>
                            </form>
                        </div>
                    </div>
                    <div class="tour-bot">
                        <p>{{$tour->tourTit.' - '.$tour->tourId}}</p>
                    </div>
                @endforeach
            @endif
            </div>
        </div>
    </div>
    <!-- ! booking popup-->

    <!-- section reviews-->
    <div id="reviews" class="container mb-60">
        <div class="row">
            <div class="col-md-8">
                <h4 class="trans-uppercase mb-10">Reviews travellers</h4>
                <div class="cws_divider mb-30"></div>

                <div class="reviews-wrap">
                    <div class="reviews-top pattern relative">
                        @if(isset($mdTourDetail))
                            @foreach($mdTourDetail as $tourHd)
                                <div class="reviews-total">
                                    @if(($tourHd->tourRate)/20 <= 1)
                                        <h5>Terrible</h5>
                                    @elseif(($tourHd->tourRate)/20 <= 2)
                                        <h5>Bad</h5>
                                    @elseif(($tourHd->tourRate)/20 <= 3)
                                        <h5>Normal</h5>
                                    @elseif(($tourHd->tourRate)/20 <= 4)
                                        <h5>Good</h5>
                                    @elseif(($tourHd->tourRate)/20 <= 5)
                                        <h5>Excellent</h5>
                                    @endif
                                    <div class="reviews-sub-mark">{{($tourHd->tourRate)/20}}</div>
                                    <div class="stars-perc"><span style="width:{{$tourHd->tourRate}}%; max-width: 100%"></span></div><span>{{$tourHd->tourRateSeq}} reviews</span>
                                </div>
                                <div class="reviews-marks">
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="comments">
                        @if(isset($mdTourComment))
                            @foreach($mdTourComment as $tourCm)
                                <div class="comment-body">
                                    <div class="avatar"><img src="/resources/assets/img/dummy.png" data-at2x="/resources/assets/img/dummy.png" alt></div>
                                    <div class="comment-info">
                                        <div class="comment-meta">
                                            <div class="title">
                                                <h5>{{$tourCm->cmTit}} <span>{{$tourCm->cmLName.' '.$tourCm->cmFName}}</span></h5>
                                            </div>
                                            <div class="comment-date">
                                                <div class="stars stars-{{$tourCm->cmRate}}">{{$tourCm->cmRate}}</div><span>{{$tourCm->cmCrtDt}}</span>
                                            </div>
                                        </div>
                                        <div class="comment-content">
                                            <p>{{$tourCm->cmCnt}}</p>
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

                <h4 class="trans-uppercase mb-10">Write a review</h4>
                <div class="cws_divider mb-30"></div>

                <div class="review-content pattern relative">
                    @if(isset($mdTourDetail))
                        @foreach($mdTourDetail as $tourVw)
                            <div class="row">
                                <div class="col-md-5 mb-md-30 mb-xs-0">
                                    <div class="review-total"><img src="{{$tourVw->imgUrl}}" data-at2x="{{$tourVw->imgUrl}}" alt>
                                        <div class="review-total-content">
                                            <h6>{{$tourVw->tourTit}}</h6>
                                            <div class="stars-perc"><span style="width:{{$tourVw->tourRate}}%"></span></div><span>{{$tourVw->tourRateSeq}} reviews</span>
                                            <ul class="icon">
                                                <li>{{$tourVw->prvNm}}, {{$tourVw->ntnNm}}<i class="flaticon-suntour-map"></i></li>
                                            </ul>
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
                            <form id="tour-review-form" class="form clearfix" action="" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="feedback-form-success" class="review_server_response"></div>
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="GET">
                                        <input id="rateValue" name="rateValue" type="hidden" value="5" aria-required="true" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="hidden" id="tourID" name="tourID" value="{{$tourVw->tourId}}"  aria-required="true" required>
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
                            <h2 class="widget-title alt">Tour Relative</h2>
                            @if(isset($mdTourRelate))
                                @foreach($mdTourRelate as $tr)
                                <!-- item recent post-->
                                    <div class="item-recent clearfix">
                                        <div class="widget-post-media"><img src="{{$tr->imgTp =='R' ? $tr->imgUrl : url('/').$tr->imgUrl}}" data-at2x="{{$tr->imgTp =='R' ? substr($tr->imgUrl, 0, -4).'@2x'.substr($tr->imgUrl, -4, 4) : substr(url('/').$tr->imgUrl, 0, -4).'@2x'.substr(url('/').$tr->imgUrl, -4, 4)}}" alt="{{$tr->imgAlt}}"></div>
                                        <h3 class="title"><a href="{{url('tour-detail/'.$tr->tourTxtLnk)}}">{{$tr->tourTit}}</a></h3>
                                        <div class="date-recent">{{$tr->crtDt}}</div>
                                    </div>
                                    <!-- ! item recent post-->
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <!-- ! widget post-->
                </aside>
            </div>
        </div>
    </div>
</section>
