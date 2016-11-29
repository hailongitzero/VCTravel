<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/28/2016
 * Time: 10:36 AM
 */
?>
<div id="content">
    <div class="page-header">
        <div class="pull-left">
            <h4><i class="icon-table"></i> Tables</h4>
        </div>
        <div class="pull-right">
            <ul class="bread">
                <li><a href="dashboard.html">Home</a><span class="divider">/</span></li>
                <li class='active'>Tables</li>
            </ul>
        </div>
    </div>

    <div class="container-fluid" id="content-area">
        <div class="row-fluid">
            <div class="span12">
                <div class="box">
                    <div class="box-head">
                        <i class="icon-table"></i>
                        <span>Dynamic tables</span>
                    </div>
                    <div class="box-body box-body-nopadding">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="POST">
                        <input name="header" type="hidden" value="{{ csrf_token() }}">
                        <table class="table table-nomargin table-bordered dataTable table-striped table-hover" id="tbNewsList">
                            <thead>
                            <tr>
                                <th>Tiêu Đề</th>
                                <th>Tin Tức Nổi Bật</th>
                                <th>Hiển Thị</th>
                                <th>Chỉnh Sữa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($adminNewsList))
                                @foreach($adminNewsList as $list)
                                    <tr>
                                        <td><a href="{{ url('news-detail/'.$list->NEWS_TEXT_LINK) }}" target="_blank" >{{$list->NEWS_ID.'-'.$list->NEWS_TITLE_VI}}</a></td>
                                        <td><input type="checkbox" class="switch-checkbox" name="rdoNewsHot" {{$list->NEWS_HOT_YN == 'Y' ? 'checked' : ''}} data-size="mini"></td>
                                        <td><input type="checkbox" class="switch-checkbox" name="rodNewsActive" {{$list->NEWS_ACT_YN == 'Y' ? 'checked' : ''}} data-size="mini"></td>
                                        <td>
                                            <a id="newsSave" href="#" class="btn-icon" item-data="{{$list->NEWS_ID}}"><i class="icon-save"></i></a>
                                            <a id="newsEdit" href="{{url('admin/news-edit/'.$list->NEWS_ID)}}" class="btn-icon"><i class="icon-edit"></i></a>
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