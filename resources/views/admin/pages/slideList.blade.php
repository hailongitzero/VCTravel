<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/30/2016
 * Time: 9:02 AM
 */
?>
<!--extends master template-->
@extends('admin.layouts.master')
<!--end extends master template-->

<!--content site section-->
@section('admin')
    @include('admin.components.slideList', $slideList)
@endsection
<!--end content site section-->