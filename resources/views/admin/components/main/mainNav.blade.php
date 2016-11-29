<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 10/7/2016
 * Time: 1:21 PM
 */?>
<div id="navigation">
    <div class="search">
        <i class="icon-search icon-white"></i>
        <form action="search-page.html" method="get">
            <input type="text" placeholder="Search here" />
        </form>
        <div class="dropdown">
            <a href="dashboard.html#" class='search-settings dropdown-toggle' data-toggle="dropdown"><i class="icon-cog icon-white"></i></a>
            <ul class="dropdown-menu">
                <li class='sort-by'>
                    Sort by <span class='filter'>Categories</span> <span class="order">A-Z</span>
                </li>
                <li class="heading">
                    Filter categories
                </li>
                <li class='filter active'>
                    Categories
                </li>
                <li class="filter">
                    Countries
                </li>
                <li class="filter">
                    Likes
                </li>
                <li class="heading">
                    Sorting order
                </li>
                <li class='order active'>
                    Ascending
                </li>
                <li class="order">
                    Descending
                </li>
            </ul>
        </div>
    </div>

    <ul class="mainNav" data-open-subnavs="multi">
        <li class='active'>
            <a href="dashboard.html"><i class="icon-home icon-white"></i><span>Dashboard</span></a>
        </li>
        <li>
            <a href="#"><i class="icon-edit icon-white"></i><span>Tour</span></a>
            <ul class="subnav">
                <li>
                    <a href="{{ url('admin/tour-list') }}">Tour List</a>
                </li>
                <li>
                    <a href="{{ url('admin/tour-edit') }}">Add Tour</a>
                </li>
                <li>
                    <a href="{{ url('admin/tour-edit') }}">Tour Booking</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="icon-edit icon-white"></i><span>News</span></a>
            <ul class="subnav">
                <li>
                    <a href="{{ url('admin/news-list') }}">News List</a>
                </li>
                <li>
                    <a href="{{ url('admin/news-edit') }}">Add News</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="icon-edit icon-white"></i><span>Guides</span></a>
            <ul class="subnav">
                <li>
                    <a href="{{ url('admin/guide-list') }}">Guide List</a>
                </li>
                <li>
                    <a href="{{ url('admin/guide-edit') }}">Add Guide</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="icon-edit icon-white"></i><span>Pages</span></a>
            <ul class="subnav">
                <li>
                    <a href="{{ url('admin/page-list') }}">Pages List</a>
                </li>
                <li>
                    <a href="{{ url('admin/page-edit') }}">Add Page</a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="status button">
        <div class="status-top">
            <div class="left">
                Saving changes...
            </div>
        </div>
        <div class="status-bottom">
            <div class="progress">
                <div class="bar" style="width:60%">60%</div>
            </div>
        </div>
    </div>

</div>
