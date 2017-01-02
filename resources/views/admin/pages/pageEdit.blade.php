<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 12/28/2016
 * Time: 3:58 PM
 */?>
<!--extends master template-->
@extends('admin.layouts.master')
<!--end extends master template-->

<!--content site section-->
@section('admin')
    @if(isset($pageDetail))
        @include('admin.components.pageEdit', $pageDetail)
    @else
        @include('admin.components.pageEdit')
    @endif
@endsection
<!--end content site section-->
