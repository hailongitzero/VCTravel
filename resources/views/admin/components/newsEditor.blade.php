<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/28/2016
 * Time: 1:27 PM
 */?>
<div id="content">
    <div class="page-header">
        <div class="pull-left">
            <h4><i class="icon-file-alt"></i> Forms - Basic forms</h4>
        </div>
        <div class="pull-right">
            <ul class="bread">
                <li><a href="dashboard.html">Home</a><span class="divider">/</span></li>
                <li><a href="basic-forms.html">Forms</a><span class="divider">/</span></li>
                <li class='active'>Basic forms</li>
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
                        @if(isset($newsDetail))
                            @foreach($newsDetail as $dt)
                                <form id="newsEditorForm" action=" " method="POST" class='form-horizontal form-bordered form-column'>
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="POST">
                                    <input type="hidden" name="newsId" id="newsId" value="{{ $dt->NEWS_ID }}">
                                    <div class="span6">
                                        <div class="control-group">
                                            <label for="titleVi" class="control-label">Tiêu Đề</label>
                                            <div class="controls">
                                                <input type="text" name="titleVi" id="titleVi" placeholder="Tiêu đề" class="input-xlarge" value="{{ $dt->NEWS_TITLE_VI }}">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="title-en" class="control-label">Title</label>
                                            <div class="controls">
                                                <input type="text" name="titleEn" id="titleEn" placeholder="Title" class="input-xlarge" value="{{ $dt->NEWS_TITLE_EN }}">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="category" class="control-label">Danh Mục</label>
                                            <div class="controls">
                                                <div class="input-xlarge">
                                                    <select name="category" id="category" class='chosen-select'>
                                                        @if(isset($categoryList))
                                                            @foreach($categoryList as $cl)
                                                                <option id="cate" value="{{ $cl->POST_GRP_ID }}" {{ $dt->POST_GRP_ID == $cl->POST_GRP_ID ? "selected" : ""}}>{{ $cl->POST_NM_VI }}</option>
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
                                                    <input type="checkbox" name="newsHot" id="newsHot" {{ $dt->NEWS_HOT_YN == "Y" ? "checked" : "" }}> Tin nóng
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Text Link</label>
                                            <div class="controls">
                                                <input type="text" name="textLink" id="textLink" placeholder="Text link" class="input-xlarge" value="{{ $dt->NEWS_TEXT_LINK }}">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="shrtCntVi" class="control-label">Tóm Tắt</label>
                                            <div class="controls">
                                                <textarea name="shrtCntVi" id="shrtCntVi" rows="5" class="input-block-level">{{ $dt->NEWS_SHRT_CNT_VI }}</textarea>
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
                                                    <textarea name="ck" id="newsCntVi" class='ckeditor span12' rows="5">{!! $dt->NEWS_CNT_EN !!} </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="keywordVi" class="control-label">Từ Khóa</label>
                                            <div class="controls">
                                                <input type="text" name="keywordVi" id="keywordVi" data-role="tagsinput" value="{{ $dt->NEWS_KEYWORD_VI }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{--right col --}}
                                    <div class="span6">
                                        <div class="control-group">
                                            <label for="fileupload" class="control-label">Hình đại diện</label>
                                            <div class="controls">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new thumbnail" style="width: 250px; height: 183px;"><img id="rpvImgDsp" src="{{$dt->IMG_TP =='R' ? $dt->IMG_URL : url('/').$dt->IMG_URL}}" /></div>
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 183px; line-height: 20px;"></div>
                                                    <div>
                                                    <span class="button button-basic btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                        <input type="file" name="rpvImg" id="rpvImg"/>
                                                    </span>
                                                        <a href="extended-forms.html#" class="button button-basic fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                        <input name="txtRpvImgLnk" id="txtRpvImgLnk" type="text" placeholder="Image link" class='input-large'>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="shrtCntEn" class="control-label"></label>
                                            <div class="controls">
                                                <textarea name="shrtCntEn" id="shrtCntEn" rows="5" class="input-block-level">{{ $dt->NEWS_SHRT_CNT_EN }}</textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="newsCntEn" class="control-label"></label>
                                            <div class="controls">
                                                <div class="box-head">
                                                    <i class="icon-list-ul"></i>
                                                    <span>Tour Content</span>
                                                </div>
                                                <div class="box-body box-body-nopadding">
                                                    <textarea name="newsCntEn" id="newsCntEn" class='ckeditor span12' rows="5">{!! $dt->NEWS_CNT_EN !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="keywordEn" class="control-label">Key Words</label>
                                            <div class="controls">
                                                <div class="span12"><input type="text" name="keywordEn" id="keywordEn" data-role="tagsinput" value="{{ $dt->NEWS_KEYWORD_EN }}"></div>
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
                            <form id="newsEditorForm" action=" " method="POST" class='form-horizontal form-bordered form-column'>
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
                                        <label for="title-en" class="control-label">Title</label>
                                        <div class="controls">
                                            <input type="text" name="titleEn" id="titleEn" placeholder="Title" class="input-xlarge">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="category" class="control-label">Danh Mục</label>
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
                                        <label class="control-label">Trạng Thái</label>
                                        <div class="controls">
                                            <label class='checkbox' style="width: 40%; display: inline-block">
                                                <input type="checkbox" name="newsHot" id="newsHot"> Tin nóng
                                            </label>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Text Link</label>
                                        <div class="controls">
                                            <input type="text" name="textLink" id="textLink" placeholder="Text link" class="input-xlarge">
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
                                                <textarea name="ck" id="newsCntVi" class='ckeditor span12' rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="keywordVi" class="control-label">Từ Khóa</label>
                                        <div class="controls">
                                            <input type="text" name="keywordVi" id="keywordVi" data-role="tagsinput" value="">
                                        </div>
                                    </div>
                                </div>

                                {{--right col --}}
                                <div class="span6">
                                    <div class="control-group">
                                        <label for="fileupload" class="control-label">Hình đại diện</label>
                                        <div class="controls">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="width: 250px; height: 183px;"><img id="rpvImgDsp" src="/resources/assets/img/no-image.png" /></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 183px; line-height: 20px;"></div>
                                                <div>
                                                    <span class="button button-basic btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                        <input type="file" name="rpvImg" id="rpvImg"/>
                                                    </span>
                                                    <a href="extended-forms.html#" class="button button-basic fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    <input name="txtRpvImgLnk" id="txtRpvImgLnk" type="text" placeholder="Image link" class='input-large'>
                                                </div>
                                            </div>
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
                                                <textarea name="newsCntEn" id="newsCntEn" class='ckeditor span12' rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="keywordEn" class="control-label">Key Words</label>
                                        <div class="controls">
                                            <div class="span12"><input type="text" name="keywordEn" id="keywordEn" data-role="tagsinput" value=""></div>
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
