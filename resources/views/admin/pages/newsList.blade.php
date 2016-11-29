<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/28/2016
 * Time: 10:58 AM
 */?>
<!--extends master template-->
@extends('admin.layouts.master')
<!--end extends master template-->

<!--content site section-->
@section('admin')
    @include('admin.components.newsList', $newsList)
@endsection
<!--end content site section-->
