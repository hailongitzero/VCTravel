<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/30/2016
 * Time: 4:40 PM
 */
?>
<div id="content">
    <div class="page-header">
        <div class="pull-left">
            <h4><i class="icon-file-alt"></i> slide Edit</h4>
        </div>
        <div class="pull-right">
            <ul class="bread">
                <li><a href="{{ url('admin') }}">Home</a><span class="divider">/</span></li>
                <li><a href="{{ url('admin/slide-list') }}">slide List</a><span class="divider">/</span></li>
                <li class='active'>slide Edit</li>
            </ul>
        </div>
    </div>

    <div class="container-fluid" id="content-area">
        <div class="row-fluid">
            <div class="span12">
                <div class="box">
                    <div class="box-head">
                        <i class="icon-list-ul"></i>
                        <span>Slide Editor</span>
                    </div>
                    <div class="box-body box-body-nopadding">
                        <div class="tour_server_response"></div>
                        @if(isset($slideDetail))
                            @foreach($slideDetail as $dt)
                                <form id="slideEditorForm" action=" " method="POST" class='form-horizontal form-bordered form-column'>
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="POST">
                                    <input type="hidden" name="slideId" id="slideId" value="{{ $dt->SLD_ID }}">
                                    <div class="span6">
                                        <div class="control-group">
                                            <label for="titleVi" class="control-label">Tiêu Đề</label>
                                            <div class="controls">
                                                <input type="text" name="titleVi" id="titleVi" placeholder="Tiêu đề" class="input-xlarge" value="{{ $dt->SLD_TITLE_VI }}">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="title-en" class="control-label">Title</label>
                                            <div class="controls">
                                                <input type="text" name="titleEn" id="titleEn" placeholder="Title" class="input-xlarge" value="{{ $dt->SLD_TITLE_EN }}">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Liên kết</label>
                                            <div class="controls">
                                                <input type="text" name="textLink" id="textLink" placeholder="Liên kết" class="input-xlarge" value="{{ $dt->SLD_LINK }}">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Mô tả ảnh</label>
                                            <div class="controls">
                                                <input type="text" name="sldImgAlt" id="sldImgAlt" placeholder="Mô tả ảnh" class="input-xlarge" value="{{ $dt->SLD_IMG_ALT }}">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="slideSeq" class="control-label">Vị trí</label>
                                            <div class="controls">
                                                <div class="input-xlarge">
                                                    <select class='chosen-select' name="slideSeq" id="slideSeq">
                                                        <option value="1"{{ $dt->SLD_SEQ == 1 ? "selected" : "" }}>1</option>
                                                        <option value="2"{{ $dt->SLD_SEQ == 2 ? "selected" : "" }}>2</option>
                                                        <option value="3"{{ $dt->SLD_SEQ == 3 ? "selected" : "" }}>3</option>
                                                        <option value="4"{{ $dt->SLD_SEQ == 4 ? "selected" : "" }}>4</option>
                                                        <option value="5"{{ $dt->SLD_SEQ == 5 ? "selected" : "" }}>5</option>
                                                        <option value="6"{{ $dt->SLD_SEQ == 6 ? "selected" : "" }}>Không Hiển Thị</option>
                                                    </select>
                                                </div>
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
                                                    <textarea name="ck" id="slideCntVi" class='ckeditor span12' rows="5">{!! $dt->SLD_CONTENT_VI !!} </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--right col --}}
                                    <div class="span6">
                                        <div class="control-group">
                                            <label for="fileupload" class="control-label">Hình đại diện</label>
                                            <div class="controls">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new thumbnail" style="width: 250px; height: 183px;"><img id="rpvImgDsp" src="{{$dt->SLD_IMG_URL}}" alt="{{ $dt->SLD_IMG_ALT }}" /></div>
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
                                            <label for="slideCntEn" class="control-label"></label>
                                            <div class="controls">
                                                <div class="box-head">
                                                    <i class="icon-list-ul"></i>
                                                    <span>Tour Content</span>
                                                </div>
                                                <div class="box-body box-body-nopadding">
                                                    <textarea name="slideCntEn" id="slideCntEn" class='ckeditor span12' rows="5">{!! $dt->SLD_CONTENT_VI !!}</textarea>
                                                </div>
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
                            <form id="slideEditorForm" action=" " method="POST" class='form-horizontal form-bordered form-column'>
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="POST">
                                <div class="span6">
                                    <div class="control-group">
                                        <label for="titleVi" class="control-label">Tiêu Đề</label>
                                        <div class="controls">
                                            <input type="text" name="titleVi" id="titleVi" placeholder="Tiêu đề" class="input-xlarge" value="">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="title-en" class="control-label">Title</label>
                                        <div class="controls">
                                            <input type="text" name="titleEn" id="titleEn" placeholder="Title" class="input-xlarge" value="">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Liên kết</label>
                                        <div class="controls">
                                            <input type="text" name="textLink" id="textLink" placeholder="Liên kết" class="input-xlarge" value="">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="category" class="control-label">Danh Mục</label>
                                        <div class="controls">
                                            <div class="input-xlarge">
                                                <select class='chosen-select' name="slideSeq" id="slideSeq">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">Không Hiển Thị</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Mô tả ảnh</label>
                                        <div class="controls">
                                            <input type="text" name="sldImgAlt" id="sldImgAlt" placeholder="Mô tả ảnh" class="input-xlarge" value="">
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
                                                <textarea name="ck" id="slideCntVi" class='ckeditor span12' rows="5"></textarea>
                                            </div>
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
                                        <label for="slideCntEn" class="control-label"></label>
                                        <div class="controls">
                                            <div class="box-head">
                                                <i class="icon-list-ul"></i>
                                                <span>Slide Content</span>
                                            </div>
                                            <div class="box-body box-body-nopadding">
                                                <textarea name="slideCntEn" id="slideCntEn" class='ckeditor span12' rows="5"></textarea>
                                            </div>
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

