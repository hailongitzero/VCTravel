<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 11/22/2016
 * Time: 11:36 AM
 */?>
<div id="content">
    <div class="page-header">
        <div class="pull-left">
            <h4><i class="icon-file-alt"></i> Forms - Extended forms</h4>
        </div>
        <div class="pull-right">
            <ul class="bread">
                <li><a href="dashboard.html">Home</a><span class="divider">/</span></li>
                <li><a href="basic-forms.html">Forms</a><span class="divider">/</span></li>
                <li class='active'>Extended forms</li>
            </ul>
        </div>
    </div>

    <div class="container-fluid" id="content-area">
        <div class="row-fluid">
            <div class="span6">
                <div class="box">
                    <div class="box-head">
                        <i class="icon-list-ul"></i>
                        <span>Image Upload</span>
                    </div>
                    <div class="box-body box-body-nopadding">
                        <form action="extended-forms.html#" method="POST" class='form-horizontal form-bordered'>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Custom Tag input</label>
                                <div class="controls">
                                    <div class="span12"><input type="text" name="textfield" id="textfield" class="tagsinput" value="PHP,Laravel,Java"></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Select with search</label>
                                <div class="controls">
                                    <div class="input-xlarge"><select name="select" id="select" class='chosen-select'>
                                            <option value="1">Option-1</option>
                                            <option value="2">Option-2</option>
                                            <option value="3">Option-3</option>
                                            <option value="4">Option-4</option>
                                            <option value="5">Option-5</option>
                                            <option value="6">Option-6</option>
                                            <option value="7">Option-7</option>
                                            <option value="8">Option-8</option>
                                            <option value="9">Option-9</option>
                                        </select></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Multiple select</label>
                                <div class="controls">
                                    <select name="a" id="a" multiple="multiple" class="chosen-select input-xxlarge">
                                        <option value="1">Option-1</option>
                                        <option value="2">Option-2</option>
                                        <option value="3">Option-3</option>
                                        <option value="4">Option-4</option>
                                        <option value="5">Option-5</option>
                                        <option value="6">Option-6</option>
                                        <option value="7">Option-7</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Spinner</label>
                                <div class="controls">
                                    <input type="text" name="textfield" id="textfield" value="3" class="spinner input-mini">
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Custom file upload</label>
                                <div class="controls">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-append">
                                            <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="button button-basic btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file" /></span><a href="extended-forms.html#" class="button button-basic fileupload-exists" data-dismiss="fileupload">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label"></label>
                                <div class="controls">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <span class="button button-basic btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file" /></span>
                                        <span class="fileupload-preview"></span>
                                        <a href="extended-forms.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label"></label>
                                <div class="controls">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" /></div>
                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                        <div>
                                            <span class="button button-basic btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" /></span>
                                            <a href="extended-forms.html#" class="button button-basic fileupload-exists" data-dismiss="fileupload">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Dual multiselect</label>
                                <div class="controls">
                                    <select multiple="multiple" id="my-select" name="my-select[]" class='multiselect'>
                                        <option value='elem_1'>elem 1</option>
                                        <option value='elem_2'>elem 2</option>
                                        <option value='elem_3'>elem 3</option>
                                        <option value='elem_4'>elem 4</option>
                                        <option value='elem_100'>elem 100</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="textfield" class="control-label">Dual multiselect with optgroup</label>
                                <div class="controls">
                                    <select multiple="multiple" id="my-select" name="my-select[]" class='multiselect' data-selectionheader="Selection header" data-selectableheader="Selectable header">
                                        <optgroup label="Like">
                                            <option value="1">Option 1</option>
                                            <option value="2">Option 2</option>
                                            <option value="3">Option 3</option>
                                        </optgroup>
                                        <optgroup label="Dislike">
                                            <option value="4">Option 4</option>
                                            <option value="5">Option 5</option>
                                            <option value="6">Option 6</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="slider" class="control-label">Basic slider (step: 25)</label>
                                <div class="controls">
                                    <div class="slider" data-step="25" data-min="0" data-max="250">
                                        <div class="amount"></div>
                                        <div class="slide"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="slider" class="control-label">Range slider</label>
                                <div class="controls">
                                    <div class="slider" data-step="5" data-min="0" data-max="75" data-range="true" data-rangestart="15" data-rangestop="45">
                                        <div class="amount"></div>
                                        <div class="slide"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
