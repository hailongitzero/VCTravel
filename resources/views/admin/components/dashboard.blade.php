<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 10/7/2016
 * Time: 1:24 PM
 */?>
<div id="content">
    <div class="page-header">
        <div class="pull-left">
            <h4><i class="icon-home"></i> Dashboard</h4>
        </div>
        <div class="pull-right">
            <ul class="bread">
                <li><a href="dashboard.html">Home</a><span class="divider">/</span></li>
                <li class='active'>Dashboard</li>
            </ul>
        </div>
    </div>
    <div class="content-highlighted">
        <ul class="quick" data-collapse="collapse">
            <li>
                <a href="dashboard.html#"><img src="resources/assets/admin/img/icons/statistics.png" alt="" /><span>Check statistics</span></a>
            </li>
            <li>
                <a href="dashboard.html#"><img src="resources/assets/admin/img/icons/order-149.png" alt="" /><span>Task list</span></a>
            </li>
            <li>
                <a href="dashboard.html#"><img src="resources/assets/admin/img/icons/shipping.png" alt="" /><span>Recent orders</span></a>
            </li>
            <li>
                <a href="dashboard.html#"><img src="resources/assets/admin/img/icons/my-account.png" alt="" /><span>Account settings</span></a>
            </li>
            <li>
                <a href="dashboard.html#"><img src="resources/assets/admin/img/icons/full-time.png" alt="" /><span>Cronjobs</span></a>
            </li>
            <li>
                <a href="dashboard.html#"><img src="resources/assets/admin/img/icons/date.png" alt="" /><span>Events</span></a>
            </li>
            <li>
                <a href="dashboard.html#"><img src="resources/assets/admin/img/icons/lock.png" alt="" /><span>Security settings</span></a>
            </li>
            <li>
                <a href="dashboard.html#"><img src="resources/assets/admin/img/icons/refresh.png" alt="" /><span>Renew cache</span></a>
            </li>
        </ul>
    </div>

    <div class="container-fluid" id="content-area">
        <div class="row-fluid">
            <div class="span6">
                <div class="box">
                    <div class="box-head">
                        <i class="icon-bar-chart"></i>
                        <span>Statistics</span>
                        <div class="actions">
                            <a href="dashboard.html#" rel='tooltip' title="Print statistics"><i class="icon-print"></i></a>
                            <a href="dashboard.html#" rel='tooltip' title="Save for later"><i class="icon-save"></i></a>
                        </div>
                    </div>
                    <div class="box-body">
                        <ul class="charts">
                            <li>
                                <div class="chart" data-percent="76">76%</div>
                                <span>HDD space</span>
                            </li>
                            <li>
                                <div class="chart" data-percent="15">15%</div>
                                <span>Memory used</span>
                            </li>
                            <li>
                                <div class="chart" data-percent="41">41%</div>
                                <span>Traffic</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="box">
                    <div class="box-head">
                        <i class="icon-tasks"></i>
                        <span>Pending tasks</span>
                        <div class="actions">
                            <a href="dashboard.html#" rel='tooltip' title="Share"><i class="icon-share"></i></a>
                            <a href="dashboard.html#" rel='tooltip' title="Mark all as done" data-placement="left"><i class="icon-check"></i></a>
                        </div>
                    </div>
                    <div class="box-body box-body-nopadding">
                        <ul class="tasklist">
                            <li class='bookmarked'>
                                <label class='checkbox'><input type="checkbox"></label>
                                <span class="task"><i class="icon-gift"></i><span>Buy christmas presents</span></span>
                                <span class="task-actions">
											<a href="dashboard.html#" class='task-bookmark' rel="tooltip" title="Important"><i class="icon-bookmark-empty"></i></a>
										</span>
                            </li>
                            <li>
                                <label class='checkbox'><input type="checkbox"></label>
                                <span class="task"><i class="icon-glass"></i><span>Get a drink with your friend</span></span>
                                <span class="task-actions">
											<a href="dashboard.html#" class='task-bookmark' rel="tooltip" title="Important"><i class="icon-bookmark-empty"></i></a>
										</span>
                            </li>
                            <li class='done'>
                                <label class='checkbox'><input type="checkbox" checked="checked"></label>
                                <span class="task"><i class="icon-briefcase"></i><span>Check for new mails</span></span>
                                <span class="task-actions">
											<a href="dashboard.html#" class='task-bookmark' rel="tooltip" title="Important"><i class="icon-bookmark-empty"></i></a>
										</span>
                            </li>
                            <li>
                                <label class='checkbox'><input type="checkbox"></label>
                                <span class="task"><i class="icon-retweet"></i><span>Go and tweet some stuff</span></span>
                                <span class="task-actions">
											<a href="dashboard.html#" class='task-bookmark' rel="tooltip" title="Important"><i class="icon-bookmark-empty"></i></a>
										</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
