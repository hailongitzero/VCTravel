<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/1/2016
 * Time: 10:49 AM
 */
?>
<div id="content">
    <div class="page-header">
        <div class="pull-left">
            <h4><i class="icon-table"></i> Tour</h4>
        </div>
        <div class="pull-right">
            <ul class="bread">
                <li><a href="{{ url('admin') }}">Home</a><span class="divider">/</span></li>
                <li class='active'>Tour</li>
            </ul>
        </div>
    </div>

    <div class="container-fluid" id="content-area">
        <div class="row-fluid">
            <div class="span12">
                <div class="box">
                    <div class="box-head">
                        <i class="icon-table"></i>
                        <span>Danh Sách Tour</span>
                    </div>
                    <div class="box-body box-body-nopadding">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="POST">
                        <input name="header" type="hidden" value="{{ csrf_token() }}">
                        <table class="table table-nomargin table-bordered dataTable table-striped table-hover" id="tbTourList">
                            <thead>
                                <tr>
                                    <th>Tiêu Đề</th>
                                    <th>Tour Nổi Bật</th>
                                    <th>Tour Phổ Biến</th>
                                    <th>Hiển Thị</th>
                                    <th>Chỉnh Sữa</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($adminTourList))
                                @foreach($adminTourList as $list)
                                <tr>
                                    <td><a href="{{ url('tour-detail/'.$list->tourTxtLnk) }}" target="_blank" >{{$list->tourId.'-'.$list->tourTit}}</a></td>
                                    <td><input type="checkbox" class="switch-checkbox" name="rdoTourFeature" {{$list->tourFeature == 'Y' ? 'checked' : ''}} data-size="mini"></td>
                                    <td><input type="checkbox" class="switch-checkbox" name="rdoTourRecommend" {{$list->tourRecommend == 'Y' ? 'checked' : ''}} data-size="mini"></td>
                                    <td><input type="checkbox" class="switch-checkbox" name="rodTourActive" {{$list->tourActive == 'Y' ? 'checked' : ''}} data-size="mini"></td>
                                    <td>
                                        <a id="tourSave" href="#" class="btn-icon" item-data="{{$list->tourId}}"><i class="icon-save"></i></a>
                                        <a id="tourEdit" href="{{url('admin/tour-edit/'.$list->tourId)}}" class="btn-icon"><i class="icon-edit"></i></a>
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
