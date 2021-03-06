<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 12/28/2016
 * Time: 3:23 PM
 */?>
<div id="content">
    <div class="page-header">
        <div class="pull-left">
            <h4><i class="icon-table"></i> Trang</h4>
        </div>
        <div class="pull-right">
            <ul class="bread">
                <li><a href="{{ url('admin') }}">Home</a><span class="divider">/</span></li>
                <li class='active'>Trang</li>
            </ul>
        </div>
    </div>

    <div class="container-fluid" id="content-area">
        <div class="row-fluid">
            <div class="span12">
                <div class="box">
                    <div class="box-head">
                        <i class="icon-table"></i>
                        <span>Danh Sách Trang</span>
                    </div>
                    <div class="box-body box-body-nopadding">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="POST">
                        <input name="header" type="hidden" value="{{ csrf_token() }}">
                        <table class="table table-nomargin table-bordered dataTable table-striped table-hover" id="tbNewsList">
                            <thead>
                            <tr>
                                <th>Tên Trang</th>
                                {{--<th>Tin Tức Nổi Bật</th>--}}
                                {{--<th>Hiển Thị</th>--}}
                                <th>Chỉnh Sữa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($pageList))
                                @foreach($pageList as $list)
                                    <tr>
                                        <td><a href="{{ url('pages/'.$list->MN_NM_LINK) }}" target="_blank" >{{$list->MN_NM_VI}}</a></td>
                                        {{--<td><input type="checkbox" class="switch-checkbox" name="rdoNewsHot" {{$list->NEWS_HOT_YN == 'Y' ? 'checked' : ''}} data-size="mini"></td>--}}
                                        {{--<td><input type="checkbox" class="switch-checkbox" name="rodNewsActive" {{$list->NEWS_ACT_YN == 'Y' ? 'checked' : ''}} data-size="mini"></td>--}}
                                        <td width="150px">
                                            {{--<a id="newsSave" href="#" class="btn-icon" item-data="{{$list->NEWS_ID}}"><i class="icon-save"></i></a>--}}
                                            <a id="newsEdit" href="{{url('admin/page-edit/'.$list->PAGE_ID)}}" class="btn-icon"><i class="icon-edit"></i></a>
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
