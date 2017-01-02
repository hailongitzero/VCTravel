<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/1/2016
 * Time: 3:21 PM
 */
?>
<div id="content">
    <div class="page-header">
        <div class="pull-left">
            <h4><i class="icon-file-alt"></i> Tour Edit</h4>
        </div>
        <div class="pull-right">
            <ul class="bread">
                <li><a href="{{ url('admin') }}">Home</a><span class="divider">/</span></li>
                <li><a href="{{ url('admin/tour-list') }}">Tour</a><span class="divider">/</span></li>
                <li class='active'>Tour Edit</li>
            </ul>
        </div>
    </div>

    <div class="container-fluid" id="content-area">
        <div class="row-fluid">
            <div class="span12">
                <div class="box">
                    <div class="box-head">
                        <i class="icon-list-ul"></i>
                        <span>More columns</span>
                    </div>
                    <div class="box-body box-body-nopadding">
                        <div class="tour_server_response"></div>
                        @if(isset($adminTourDetail))
                            @foreach($adminTourDetail as $dt)
                                <form id="tourEditorForm" action=" " method="GET" class='form-horizontal form-bordered form-column'>
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="POST">
                                    <input type="hidden" name="tourId" id="tourId" value="{{$dt->TOUR_ID}}">
                                    <div class="span6">
                                        <div class="control-group">
                                            <label for="titleVi" class="control-label">Tiêu Đề</label>
                                            <div class="controls">
                                                <input type="text" name="titleVi" id="titleVi" placeholder="Tiêu đề" class="input-xlarge" value="{{$dt->TOUR_TIT_VI}}" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="nation" class="control-label">Địa Điểm</label>
                                            <div class="controls">
                                                <div class="input-xmedium">
                                                    <select name="nation" id="nation" class='chosen-select'>
                                                        <option value="{{ $dt->NATIONAL_CD }}">{{ $dt->NATIONAL_NM_VI }}</option>
                                                        @if(isset($nationalList))
                                                            @foreach($nationalList as $nl)
                                                                <option value="{{ $nl->NATIONAL_CD }}">{{ $nl->NATIONAL_NM_VI }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="input-xmedium">
                                                    <select name="province" id="province" class='chosen-select'>
                                                        <option id="prv" class="{{ $dt->NATIONAL_CD }}" value="{{ $dt->LOCATION_ID }}" style="display: none" >{{ $dt->PROVINCE_NM_VI }}</option>
                                                        @if(isset($locationList))
                                                            @foreach($locationList as $ll)
                                                                <option id="prv" class="{{ $ll->NATIONAL_CD }}" value="{{ $ll->LOCATION_ID }}" style="display: none" >{{ $ll->PROVINCE_NM_VI }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Trạng Thái</label>
                                            <div class="controls">
                                                <label class='checkbox' style="width: 40%; display: inline-block">
                                                    <input type="checkbox" name="tourFtr" id="tourFtr" {{ $dt->TOUR_FTR_YN == 'Y'? 'checked': '' }}> Tour nổi bật
                                                </label>
                                                <label class='checkbox' style="width: 40%; display: inline-block">
                                                    <input type="checkbox" name="tourRcm" id="tourRcm" {{ $dt->TOUR_RCM_YN == 'Y'? 'checked': '' }}>Tour phổ biến
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="shrtCntVi" class="control-label">Tóm Tắt</label>
                                            <div class="controls">
                                                <textarea name="shrtCntVi" id="shrtCntVi" rows="5" class="input-block-level">{{$dt->TOUR_SHRT_CNT_VI}}</textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="tourCntVi" class="control-label">Nội Dung</label>
                                            <div class="controls">
                                                <div class="box-head">
                                                    <i class="icon-list-ul"></i>
                                                    <span>Nội Dung</span>
                                                </div>
                                                <div class="box-body box-body-nopadding">
                                                    <textarea name="ck" id="tourCntVi" class='ckeditor span12' rows="5">{{$dt->TOUR_CNT_VI}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="tourSchVi" class="control-label">Lịch Trình</label>
                                            <div class="controls">
                                                <div class="box-head">
                                                    <i class="icon-list-ul"></i>
                                                    <span>Lịch Trình</span>
                                                </div>
                                                <div class="box-body box-body-nopadding">
                                                    <textarea name="tourSchVi" id="tourSchVi" class='ckeditor span12' rows="5">{{ $dt->TOUR_SCHEDULE_VI }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="textfield" class="control-label">Hình Đại Diện</label>
                                            <div class="controls">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new thumbnail" style="width: 350px; height: 255px;"><img id="rpvImgDsp" src="{{$dt->IMG_TP =='R' ? $dt->IMG_URL : url('/').$dt->IMG_URL}}" /></div>
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 350px; max-height: 255px; line-height: 20px;"></div>
                                                    <div>
                                                        <span class="button button-basic btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="rpvImg"   id="rpvImg"/></span>
                                                        <a href="#" class="button button-basic fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                </div>
                                                <div class="input-append">
                                                    <input name="txtRpvImgLnk" id="txtRpvImgLnk" type="text" placeholder="Image link" class='input-xlarge'>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="tourLthVi" class="control-label">Thời gian</label>
                                            <div class="controls">
                                                <input type="text" name="tourLthVi" id="tourLthVi" placeholder="Thời gian" class="input-xlarge" value="{{$dt->TOUR_LENGTH_VI}}">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="tourPrcVi" class="control-label">Giá tiền</label>
                                            <div class="controls">
                                                <div class="input-append">
                                                    <span class="add-on">VND</span><input type="number" name="tourPrcVi" id="tourPrcVi" placeholder="Giá" class='input-small' value="{{ $dt->TOUR_PRICE_VI }}">
                                                    <span class="add-on">$</span>
                                                    <span class="add-on">USD</span><input type="number" name="tourPrcEn" id="tourPrcEn" placeholder="Price" class='input-small' value="{{ $dt->TOUR_PRICE_EN }}">
                                                    <span class="add-on">$</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="keywordVi" class="control-label">Từ Khóa</label>
                                            <div class="controls">
                                                <input type="text" name="keywordVi" id="keywordVi" data-role="tagsinput" value="{{ $dt->TOUR_KEYWORDS_VI }}" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="tourDescVi" class="control-label">Mô tả</label>
                                            <div class="controls">
                                                <input type="text" name="tourDescVi" id="tourDescVi" placeholder="Mô tả" class="input-xlarge" value="{{ $dt->TOUR_DESCRIPTION_VI }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{--right col --}}
                                    <div class="span6">
                                        <div class="control-group">
                                            <label for="title-en" class="control-label">Title</label>
                                            <div class="controls">
                                                <input type="text" name="titleEn" id="titleEn" placeholder="Title" class="input-xlarge" value="{{$dt->TOUR_TIT_EN}}">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="province" class="control-label">Danh Mục</label>
                                            <div class="controls">
                                                <div class="input-xlarge">
                                                    <select name="category" id="category" class='chosen-select'>
                                                        @if(isset($categoryList))
                                                            @foreach($categoryList as $cl)
                                                                <option id="cate" value="{{ $cl->POST_GRP_ID }}" {{ $cl->POST_GRP_ID == $dt->POST_GRP_ID ? "selected" : "" }}>{{ $cl->POST_NM_VI }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Text Link</label>
                                            <div class="controls">
                                                <input type="text" name="textLink" id="textLink" placeholder="Text link" class="input-xlarge" value="{{$dt->TOUR_TEXT_LINK}}">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="shrtCntEn" class="control-label"></label>
                                            <div class="controls">
                                                <textarea name="shrtCntEn" id="shrtCntEn" rows="5" class="input-block-level">{{ $dt->TOUR_SHRT_CNT_EN }}</textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="tourCntEn" class="control-label"></label>
                                            <div class="controls">
                                                <div class="box-head">
                                                    <i class="icon-list-ul"></i>
                                                    <span>Tour Content</span>
                                                </div>
                                                <div class="box-body box-body-nopadding">
                                                    <textarea name="tourCntEn" id="tourCntEn" class='ckeditor span12' rows="5">{{ $dt->TOUR_CNT_EN }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="tourSchEn" class="control-label"></label>
                                            <div class="controls">
                                                <div class="box-head">
                                                    <i class="icon-list-ul"></i>
                                                    <span>Tour Schedule</span>
                                                </div>
                                                <div class="box-body box-body-nopadding">
                                                    <textarea name="tourSchEn" id="tourSchEn" class='ckeditor span12' rows="5">{{ $dt->TOUR_SCHEDULE_EN }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="left-control">
                                                <button type="button" class='button button-basic button-basic-blue btn-control' name="btnRef" id="btnRef"><i class="icon-link"></i> Ref.Lnk</button>
                                                <button type="button" class='button button-basic button-basic-blue' name="btnUpload" id="btnUpload"><i class="icon-upload-alt"></i> Upload</button>
                                                </div>
                                            <div class="controls" id="listUpload" style="display: none;">
                                                <div class="box box-nomargin">
                                                    <div class="box-head">
                                                        <i class="icon-list-ul"></i>
                                                        <span> Multiple file upload
                                                        </span>
                                                    </div>
                                                    <div class="box-body box-body-nopadding">
                                                        <div id="uploader">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="controls" id="listRefer" style="display: block">
                                                <div class="box box-nomargin">
                                                    <div class="box-head">
                                                        <i class="icon-list-ul"></i>
                                                        <span> Image Reference Link
                                                        </span>
                                                    </div>
                                                    <div class="box-body box-body-nopadding mb-5">
                                                        <div class="img-thumb-layout">
                                                            @if(isset($photoList))
                                                                @foreach($photoList as $pl)
                                                                    <div class='img-item'><img src='{{ $pl->IMG_URL }}' alt="{{$pl->IMG_ALT}}"><button type='button' class='close' data-dismiss='alert'>×</button></div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="input-append">
                                                        <input name="txtImgLstAdd" id="txtImgLstAdd" type="text" placeholder="..." class='input-large'>
                                                        <button class="button button-basic" type="button" name="btnImgLstAdd" id="btnImgLstAdd">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="tourLthEn" class="control-label"></label>
                                            <div class="controls">
                                                <input type="text" name="tourLthEn" id="tourLthEn" placeholder="Tour length" class="input-xlarge" value="{{ $dt->TOUR_LENGTH_EN }}">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="tourPrm" class="control-label">Khuyến Mãi</label>
                                            <div class="controls">
                                                <div class="input-append">
                                                    <input type="text" name="tourPrm" id="tourPrm" placeholder="%" class='input-small' value="{{ $dt->TOUR_PRM_PRICE }}">
                                                    <span class="add-on">$</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="keywordEn" class="control-label"></label>
                                            <div class="controls">
                                                <div class="span12"><input type="text" name="keywordEn" id="keywordEn" data-role="tagsinput" value="{{ $dt->TOUR_KEYWORDS_EN }}" required></div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="tourDescEn" class="control-label"></label>
                                            <div class="controls">
                                                <input type="text" name="tourDescEn" id="tourDescEn" placeholder="Description" class="input-xlarge" value="{{ $dt->TOUR_DESCRIPTION_EN }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span12">
                                        <div class="form-actions">
                                            <button type="submit" name="btnSubmit" id="btnSubmit" class="button button-basic-blue">Update</button>
                                            <button type="button" class="button button-basic">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        @else
                            <form id="tourEditorForm" action="" method="POST" class='form-horizontal form-bordered form-column'>
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="POST">
                                <div class="span6">
                                    <div class="control-group">
                                        <label for="titleVi" class="control-label">Tiêu Đề</label>
                                        <div class="controls">
                                            <input type="text" name="titleVi" id="titleVi" placeholder="Tiêu đề" class="input-xlarge">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="nation" class="control-label">Địa Điểm</label>
                                        <div class="controls">
                                            <div class="input-xmedium">
                                                <select name="nation" id="nation" class='chosen-select'>
                                                    @if(isset($nationalList))
                                                        @foreach($nationalList as $nl)
                                                            <option value="{{ $nl->NATIONAL_CD }}">{{ $nl->NATIONAL_NM_VI }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="input-xmedium">
                                                <select name="province" id="province" class='chosen-select'>
                                                    @if(isset($locationList))
                                                        @foreach($locationList as $ll)
                                                            <option id="prv" class="{{ $ll->NATIONAL_CD }}" value="{{ $ll->LOCATION_ID }}" style="display: none" >{{ $ll->PROVINCE_NM_VI }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Trạng Thái</label>
                                        <div class="controls">
                                            <label class='checkbox' style="width: 40%; display: inline-block">
                                                <input type="checkbox" name="tourFtr" id="tourFtr"> Tour nổi bật
                                            </label>
                                            <label class='checkbox' style="width: 40%; display: inline-block">
                                                <input type="checkbox" name="tourRcm" id="tourRcm">Tour phổ biến
                                            </label>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="shrtCntVi" class="control-label">Tóm Tắt</label>
                                        <div class="controls">
                                            <textarea name="shrtCntVi" id="shrtCntVi" rows="5" class="input-block-level"></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="tourCntVi" class="control-label">Nội Dung</label>
                                        <div class="controls">
                                            <div class="box-head">
                                                <i class="icon-list-ul"></i>
                                                <span>Nội Dung</span>
                                            </div>
                                            <div class="box-body box-body-nopadding">
                                                <textarea name="ck" id="tourCntVi" class='ckeditor span12' rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="tourSchVi" class="control-label">Lịch Trình</label>
                                        <div class="controls">
                                            <div class="box-head">
                                                <i class="icon-list-ul"></i>
                                                <span>Lịch Trình</span>
                                            </div>
                                            <div class="box-body box-body-nopadding">
                                                <textarea name="tourSchVi" id="tourSchVi" class='ckeditor span12' rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="fileupload" class="control-label">Hình đại diện</label>
                                        <div class="controls">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="width: 350px; height: 255px;"><img id="rpvImgDsp" src="/resources/assets/img/no-image.png" /></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 350px; max-height: 255px; line-height: 20px;"></div>
                                                <div>
                                                    <span class="button button-basic btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="rpvImg" id="rpvImg"/></span>
                                                    <a href="extended-forms.html#" class="button button-basic fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                </div>
                                            </div>
                                            <div class="input-append">
                                                <input name="txtRpvImgLnk" id="txtRpvImgLnk" type="text" placeholder="Image link" class='input-xlarge'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="tourLthVi" class="control-label">Thời gian</label>
                                        <div class="controls">
                                            <input type="text" name="tourLthVi" id="tourLthVi" placeholder="Thời gian" class="input-xlarge">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="tourPrcVi" class="control-label">Giá tiền</label>
                                        <div class="controls">
                                            <div class="input-append">
                                                <span class="add-on">VND</span>
                                                <input type="number" name="tourPrcVi" id="tourPrcVi" placeholder="Giá" class='input-small'>
                                                <span class="add-on">$</span>
                                                <span class="add-on">USD</span>
                                                <input type="number" name="tourPrcEn" id="tourPrcEn" placeholder="Price" class='input-small'>
                                                <span class="add-on">$</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="keywordVi" class="control-label">Từ Khóa</label>
                                        <div class="controls">
                                            <input type="text" name="keywordVi" id="keywordVi" data-role="tagsinput" value="" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="tourDescVi" class="control-label">Mô tả</label>
                                        <div class="controls">
                                            <input type="text" name="tourDescVi" id="tourDescVi" placeholder="Mô tả" class="input-xlarge">
                                        </div>
                                    </div>
                                </div>

                                {{--right col --}}
                                <div class="span6">
                                    <div class="control-group">
                                        <label for="title-en" class="control-label">Title</label>
                                        <div class="controls">
                                            <input type="text" name="titleEn" id="titleEn" placeholder="Title" class="input-xlarge">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="province" class="control-label">Danh Mục</label>
                                        <div class="controls">
                                            <div class="input-xlarge">
                                                <select name="category" id="category" class='chosen-select'>
                                                    @if(isset($categoryList))
                                                        @foreach($categoryList as $cl)
                                                            <option id="cate" value="{{ $cl->POST_GRP_ID }}">{{ $cl->POST_NM_VI }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Text Link</label>
                                        <div class="controls">
                                            <input type="text" name="textLink" id="textLink" placeholder="Text link" class="input-xlarge">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="shrtCntEn" class="control-label"></label>
                                        <div class="controls">
                                            <textarea name="shrtCntEn" id="shrtCntEn" rows="5" class="input-block-level"></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="tourCntEn" class="control-label"></label>
                                        <div class="controls">
                                            <div class="box-head">
                                                <i class="icon-list-ul"></i>
                                                <span>Tour Content</span>
                                            </div>
                                            <div class="box-body box-body-nopadding">
                                                <textarea name="tourCntEn" id="tourCntEn" class='ckeditor span12' rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="tourSchEn" class="control-label"></label>
                                        <div class="controls">
                                            <div class="box-head">
                                                <i class="icon-list-ul"></i>
                                                <span>Tour Schedule</span>
                                            </div>
                                            <div class="box-body box-body-nopadding">
                                                <textarea name="tourSchEn" id="tourSchEn" class='ckeditor span12' rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="left-control">
                                            <button type="button" class='button button-basic button-basic-blue btn-control' name="btnRef" id="btnRef"><i class="icon-link"></i> Ref.Lnk</button>
                                            <button type="button" class='button button-basic button-basic-blue' name="btnUpload" id="btnUpload"><i class="icon-upload-alt"></i> Upload</button>
                                            </div>
                                        <div class="controls" id="listUpload" style="display: none;">
                                            <div class="box box-nomargin">
                                                <div class="box-head">
                                                    <i class="icon-list-ul"></i>
                                                    <span> Multiple file upload
                                                        </span>
                                                </div>
                                                <div class="box-body box-body-nopadding">
                                                    <div id="uploader">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="controls" id="listRefer" style="display: block">
                                            <div class="box box-nomargin">
                                                <div class="box-head">
                                                    <i class="icon-list-ul"></i>
                                                    <span> Image Reference Link
                                                        </span>
                                                </div>
                                                <div class="box-body box-body-nopadding mb-5">
                                                    <div class="img-thumb-layout">
                                                    </div>
                                                </div>
                                                <div class="input-append">
                                                    <input name="txtImgLstAdd" id="txtImgLstAdd" type="text" placeholder="..." class='input-large'>
                                                    <button class="button button-basic" type="button" name="btnImgLstAdd" id="btnImgLstAdd">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="tourLthEn" class="control-label"></label>
                                        <div class="controls">
                                            <input type="text" name="tourLthEn" id="tourLthEn" placeholder="Tour length" class="input-xlarge">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="tourPrm" class="control-label">Khuyến Mãi</label>
                                        <div class="controls">
                                            <div class="input-append">
                                                <input type="text" name="tourPrm" id="tourPrm" placeholder="%" value="0" class='input-small'>
                                                <span class="add-on">$</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="keywordEn" class="control-label"></label>
                                        <div class="controls">
                                            <input type="text" name="keywordEn" id="keywordEn" data-role="tagsinput" value="" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="tourDescEn" class="control-label"></label>
                                        <div class="controls">
                                            <input type="text" name="tourDescEn" id="tourDescEn" placeholder="Description" class="input-xlarge">
                                        </div>
                                    </div>
                                </div>
                                <div class="span12">
                                    <div class="form-actions">
                                        <button type="submit" name="btnSubmit" id="btnSubmit" class="button button-basic-blue">Save</button>
                                        <button type="button" class="button button-basic">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>