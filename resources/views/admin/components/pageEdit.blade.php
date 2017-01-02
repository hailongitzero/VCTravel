<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 12/28/2016
 * Time: 3:58 PM
 */?>
<div id="content">
    <div class="page-header">
        <div class="pull-left">
            <h4><i class="icon-file-alt"></i> Page Edit</h4>
        </div>
        <div class="pull-right">
            <ul class="bread">
                <li><a href="{{ url('admin') }}">Home</a><span class="divider">/</span></li>
                <li><a href="{{ url('admin/page-list') }}">Danh Sách Trang</a><span class="divider">/</span></li>
                <li class='active'>News Edit</li>
            </ul>
        </div>
    </div>

    <div class="container-fluid" id="content-area">
        <div class="row-fluid">
            <div class="span12">
                <div class="box">
                    <div class="box-head">
                        <i class="icon-list-ul"></i>
                        <span>Cập Nhật Trang</span>
                    </div>
                    <div class="box-body box-body-nopadding">
                        <div class="tour_server_response"></div>
                        @if(isset($pageDetail))
                            @foreach($pageDetail as $dt)
                                <form id="pageEditorForm" action=" " method="POST" class='form-horizontal form-bordered form-column'>
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="POST">
                                    <input type="hidden" name="pageId" id="pageId" value="{{ $dt->PAGE_ID }}">
                                    <div class="span6">
                                        <div class="control-group">
                                            <label for="menuNmVi" class="control-label">Tên Menu</label>
                                            <div class="controls">
                                                <input type="text" name="menuNmVi" id="menuNmVi" placeholder="Tên Menu" class="input-xlarge" value="{{ $dt->MN_NM_VI }}">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Text Link</label>
                                            <div class="controls">
                                                <input type="text" name="pageLink" id="pageLink" placeholder="Text link" class="input-xlarge" value="{{ $dt->MN_NM_LINK }}">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="pageCodeVi" class="control-label">
                                                <button type="button" name="btnViewVi" id="btnViewVi" class="button button-basic-blue">View</button>
                                            </label>
                                            <div class="controls">
                                                <div class="box-head">
                                                    <i class="icon-list-ul"></i>
                                                    <span>Page Code</span>
                                                </div>
                                                <div class="box-body box-body-nopadding">
                                                    <textarea name="ck" id="pageCodeVi" class='ckeditor span12' rows="5">{{ $dt->HTML_CODE_VI }} </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--right col --}}
                                    <div class="span6">
                                        <div class="control-group">
                                            <label for="menuNmEn" class="control-label">Tên Menu</label>
                                            <div class="controls">
                                                <input type="text" name="menuNmEn" id="menuNmEn" placeholder="Tên Menu" class="input-xlarge" value="{{ $dt->MN_NM_EN }}">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Tên Trang</label>
                                            <div class="controls">
                                                <input type="text" name="pageNm" id="pageNm" placeholder="Tên Trang" class="input-xlarge" value="{!! $dt->PAGE_NAME !!}">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="pageCodeEn" class="control-label">
                                                <button type="button" name="btnViewEn" id="btnViewEn" class="button button-basic-blue">View</button>
                                            </label>
                                            <div class="controls">
                                                <div class="box-head">
                                                    <i class="icon-list-ul"></i>
                                                    <span>Page Code</span>
                                                </div>
                                                <div class="box-body box-body-nopadding">
                                                    <textarea name="pageCodeEn" id="pageCodeEn" class='ckeditor span12' rows="5">{{ $dt->HTML_CODE_EN }}</textarea>
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
                            <form id="pageEditorForm" action=" " method="POST" class="form-horizontal form-bordered form-column">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="POST">
                                <div class="span6">
                                    <div class="control-group">
                                        <label for="menuNmVi" class="control-label">Tên Menu</label>
                                        <div class="controls">
                                            <input type="text" name="menuNmVi" id="menuNmVi" placeholder="Tên Menu" class="input-xlarge" value="">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Text Link</label>
                                        <div class="controls">
                                            <input type="text" name="pageLink" id="pageLink" placeholder="Text link" class="input-xlarge" value="">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="pageCodeVi" class="control-label">
                                            <button type="button" name="btnViewVi" id="btnViewVi" class="button button-basic-blue">View</button>
                                        </label>
                                        <div class="controls">
                                            <div class="box-head">
                                                <i class="icon-list-ul"></i>
                                                <span>Page Code</span>
                                            </div>
                                            <div class="box-body box-body-nopadding">
                                                <textarea name="ck" id="pageCodeVi" class='ckeditor span12' rows="5"> </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--right col --}}
                                <div class="span6">
                                    <div class="control-group">
                                        <label for="menuNmEn" class="control-label">Tên Menu</label>
                                        <div class="controls">
                                            <input type="text" name="menuNmEn" id="menuNmEn" placeholder="Tên Menu" class="input-xlarge" value="">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Tên Trang</label>
                                        <div class="controls">
                                            <input type="text" name="pageNm" id="pageNm" placeholder="Tên Trang" class="input-xlarge" value="">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="pageCodeEn" class="control-label">
                                            <button type="button" name="btnViewEn" id="btnViewEn" class="button button-basic-blue">View</button>
                                        </label>
                                        <div class="controls">
                                            <div class="box-head">
                                                <i class="icon-list-ul"></i>
                                                <span>Page Code</span>
                                            </div>
                                            <div class="box-body box-body-nopadding">
                                                <textarea name="pageCodeEn" id="pageCodeEn" class='ckeditor span12' rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="span12">
                                    <div class="form-actions">
                                        <button type="submit" name="btnSubmit" id="btnSubmit" class="button button-basic-blue">Update</button>
                                        <button type="button" class="button button-basic">Cancel</button>
                                        <button type="button" name="btnView" id="btnView" class="button button-basic-blue">View</button>
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

