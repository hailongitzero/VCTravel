<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/30/2016
 * Time: 4:41 PM
 */
?>
<!--extends master template-->
@extends('admin.layouts.master')
<!--end extends master template-->

<!--content site section-->
@section('admin')
    @if(isset($slideDetail))
        @include('admin.components.slideEditor', $slideDetail)
    @else
        @include('admin.components.slideEditor')
    @endif
@endsection
<!--end content site section-->
