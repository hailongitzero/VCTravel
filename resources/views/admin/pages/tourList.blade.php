<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/1/2016
 * Time: 10:43 AM
 */?>
<!--extends master template-->
@extends('admin.layouts.master')
<!--end extends master template-->

<!--content site section-->
@section('admin')
    @include('admin.components.tourList', $tourList)
@endsection
<!--end content site section-->