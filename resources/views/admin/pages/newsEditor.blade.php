<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/28/2016
 * Time: 4:38 PM
 */?>
<!--extends master template-->
@extends('admin.layouts.master')
<!--end extends master template-->

<!--content site section-->
@section('admin')
    @if(isset($newsDetail))
        @include('admin.components.newsEditor', $newsDetail)
    @else
        @include('admin.components.newsEditor',$newsInit)
    @endif
@endsection
<!--end content site section-->