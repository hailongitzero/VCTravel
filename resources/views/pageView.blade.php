<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 12/29/2016
 * Time: 3:57 PM
 */?>
{{--stack script--}}
@push('scripts')
<script type="text/javascript" src="/resources/assets/js/page-review.js"></script>
@endpush
<!--extends master template-->
@extends('layouts.master', array("header" => $headerData))
<!--end extends master template-->

<!--title site setting-->
@section('title', isset($title) ? $title : 'Vung Chua Travel')
<!--end title site setting-->

@section('meta-title', isset($metaTitle) ? $metaTitle : 'Vung Chua Travel Title')
<!--end title site setting-->

<!--description site setting-->
@section('description', isset($description) ? $description : 'Vung Chua Travel Descriptions')
<!--end description site setting-->

<!--keywords site setting-->
@section('keywords', isset($keywords) ? $keywords : 'Vung Chua Travel keywords')
<!--end keywords site setting-->

<!--author site setting-->
@section('author', isset($author) ? $author : 'Hai Long')
<!--end author site setting-->

<!--content site section-->
@section('page-content')
    @if(isset($breadCrumb))
        @include('components.breadCrumbs',$breadCrumb)
    @endif
@endsection
<!--end content site section-->
