<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/1/2016
 * Time: 3:35 PM
 */?>
<!--extends master template-->
@extends('admin.layouts.master')
<!--end extends master template-->

<!--content site section-->
@section('admin')
    @if(isset($tourEditor))
        @include('admin.components.tourEditor', $tourEditor)
    @else
        @include('admin.components.tourEditor',$tourInit)
    @endif
@endsection
<!--end content site section-->
