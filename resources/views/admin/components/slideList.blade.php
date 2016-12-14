<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/30/2016
 * Time: 9:02 AM
 */?>
<div id="content">
    <div class="page-header">
        <div class="pull-left">
            <h4><i class="icon-table"></i> Slide</h4>
        </div>
        <div class="pull-right">
            <ul class="bread">
                <li><a href="{{ url('admin') }}">Home</a><span class="divider">/</span></li>
                <li class='active'>Slide</li>
            </ul>
        </div>
    </div>

    <div class="container-fluid" id="content-area">
        <div class="row-fluid">
            <div class="span12">
                <div class="box">
                    <div class="box-head">
                        <i class="icon-table"></i>
                        <span>Danh Sách Slide</span>
                    </div>
                    <div class="box-body box-body-nopadding">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="POST">
                        <input name="header" type="hidden" value="{{ csrf_token() }}">
                        <table class="table table-nomargin table-bordered dataTable table-striped table-hover" id="tbSlideList">
                            <thead>
                            <tr>
                                <th>Tiêu Đề</th>
                                <th>Vị Trí</th>
                                <th>Liên Kết</th>
                                <th>Tùy Chỉnh</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($slideList))
                                @foreach($slideList as $list)
                                    <tr>
                                        <td>{{$list->SLD_ID.'-'.$list->SLD_TITLE_VI}}</td>
                                        <td><div class="input-xmedium">
                                                <select class='chosen-select'>
                                                    <option id="slideSeq" value="1" {{ $list->SLD_SEQ == 1 ? "selected" : "" }}>1</option>
                                                    <option id="slideSeq" value="2"{{ $list->SLD_SEQ == 2 ? "selected" : "" }}>2</option>
                                                    <option id="slideSeq" value="3"{{ $list->SLD_SEQ == 3 ? "selected" : "" }}>3</option>
                                                    <option id="slideSeq" value="4"{{ $list->SLD_SEQ == 4 ? "selected" : "" }}>4</option>
                                                    <option id="slideSeq" value="5"{{ $list->SLD_SEQ == 5 ? "selected" : "" }}>5</option>
                                                    <option id="slideSeq" value="6"{{ $list->SLD_SEQ == 6 ? "selected" : "" }}>Không Hiển Thị</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" id="slideLink" name="slideLink" value="{{ $list->SLD_LINK }}">
                                        </td>
                                        <td>
                                            <a id="slideSave" href="#" class="btn-icon" item-data="{{$list->SLD_ID}}"><i class="icon-save"></i></a>
                                            <a id="slideEdit" href="{{url('admin/slide-edit/'.$list->SLD_ID)}}" class="btn-icon"><i class="icon-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
