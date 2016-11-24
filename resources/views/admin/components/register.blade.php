<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 10/10/2016
 * Time: 10:07 AM
 */?>
<div id="content">
    <div class="page-header">
        <div class="pull-left">
            <h4><i class="icon-file-alt"></i> Admin - Đăng ký quản trị viên</h4>
        </div>
        <div class="pull-right">
            <ul class="bread">
                <li><a href="admin">Admin</a><span class="divider">/</span></li>
                <li><a href="admin/reg">Đăng Ký</a><span class="divider">/</span></li>
                <li class='active'>Đăng ký quản trị viên</li>
            </ul>
        </div>
    </div>

    <div class="container-fluid" id="content-area">
        <div class="row-fluid">
            <div class="span12">
                <div class="box">
                    <div class="box-head">
                        <i class="icon-list-ul"></i>
                        <span>Form Đăng Ký</span>
                    </div>
                    <div class="box-body box-body-nopadding">
                        <form id="admin-register" action="" method="POST" class='form-horizontal' autocomplete="off">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="POST">
                            <div class="control-group">
                                <label for="textfield" class="control-label">Email</label>
                                <div class="controls">
                                    <input type="email" name="email" id="email" placeholder="Email" class="input-xlarge">
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Tên đăng nhập</label>
                                <div class="controls">
                                    <input type="text" name="username" id="username" placeholder="Tên đăng nhập" class="input-xlarge">
                                    <span class="help-block">Tên đăng nhập không bao gồm các ký tự đặc biệt</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="password" class="control-label">Mật khẩu</label>
                                <div class="controls">
                                    <input type="password" name="password" id="password" placeholder="Mật khẩu" class="input-xlarge">
                                    <span class="help-block">Ít nhất 8 ký tự, chỉ bao gồm chữ và số.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Vai trò</label>
                                <div class="controls">
                                    <label class='radio'>
                                        <input type="radio" name="role" id="role" value="A"> Quản Trị viên
                                    </label>
                                    <label class='radio'>
                                        <input type="radio" name="role" id="role" value="M" checked> Quản lý bài viết
                                    </label>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="form-response">

                                </div>
                                <button type="submit" class="button button-basic-blue">Đăng Ký</button>
                                <button type="button" class="button button-basic">Hủy</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
