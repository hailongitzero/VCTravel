/**
 * Created by HaiLong on 11/2/2016.
 */
"use strict"; // start of use strict

$(document).ready(function() {

    //CKEditor -- text editor
    if(document.getElementById("tourCntEn") != null){
        CKEDITOR.replace( 'tourCntEn' );
        CKEDITOR.add;
    }
    if(document.getElementById("tourSchVi") != null){
        CKEDITOR.replace( 'tourSchVi' );
        CKEDITOR.add;
    }
    if(document.getElementById("tourSchEn") != null){
        CKEDITOR.replace( 'tourSchEn' );
        CKEDITOR.add;
    }

    //switch checkbox style for data table
    $("[class='switch-checkbox']").bootstrapSwitch();

    //data table on draw function event
    $('#tbTourList').on( 'draw', function () {
        $("[class='switch-checkbox']").bootstrapSwitch();
    } );

    //drop box nation on change function event
    $('#nation').change(function () {
        $('#province_chzn .active-result').css("display", "none");
        $('.'+$("#nation").chosen().val()).css("display", "block");
    });

    //change upload image list layout
    $('#btnUpload').click(function () {
        $('#listUpload').css('display','block');
        $('#listRefer').css('display','none');

        return;
    });

    //change upload image list layout
    $('#btnRef').click(function () {
        $('#listUpload').css('display','none');
        $('#listRefer').css('display','block');
        return;
    });

    $('#txtRpvImgLnk').change(function () {
        $('#rpvImgDsp').attr('src',$('#txtRpvImgLnk').val())
    });


    $('#btnImgLstAdd').click(function () {
        var imgIndex = $('.img-thumb-layout').find('.img-item');
        var imgLnk = $('#txtImgLstAdd').val();
        if ( imgLnk.length > 0){
            if(imgIndex.length < 1 ){
                $('.img-thumb-layout').append("<div class='img-item'><img src='"+imgLnk+"'><button type='button' class='close' data-dismiss='alert'>×</button></div>");
                $('#txtImgLstAdd').val('');
            }else{
                var status = true;
                for (var i = 0; i < imgIndex.length; i++) {
                    var MyIndexValue = $(imgIndex[i]).find('img').attr('src');
                    if(imgLnk == MyIndexValue){
                        status = false;
                    }
                }
                if (status == true){
                    $('.img-thumb-layout').append("<div class='img-item'><img src='"+imgLnk+"'><button type='button' class='close' data-dismiss='alert'>×</button></div>");
                    $('#txtImgLstAdd').val('');
                }
            }
        }
    });

    // $("#imgListUpload");
    $("#uploader").plupload({
        // General settings
        runtimes : 'html5,flash,silverlight,html4',
        url : '../upload.php',
        // User can upload no more then 20 files in one go (sets multiple_queues to false)
        max_file_count: 20,

        chunk_size: '1mb',
        // Resize images on clientside if we can
        resize : {
            width : 200,
            height : 200,
            quality : 90,
            crop: true // crop to exact dimensions
        },

        filters : {
            // Maximum file size
            max_file_size : '1000mb',
            // Specify what files to browse for
            mime_types: [
                {title : "Image files", extensions : "jpg,gif,png"},
                // {title : "Zip files", extensions : "zip"}
            ]
        },
        // Rename files by clicking on their titles
        rename: true,

        // Sort files
        sortable: true,
        // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
        dragdrop: true,
        // Views to activate
        views: {
            list: true,
            thumbs: true, // Show thumbs
            active: 'thumbs'
        },
        // Flash settings
        flash_swf_url : '../../js/Moxie.swf',
        // Silverlight settings
        silverlight_xap_url : '../../js/Moxie.xap'
    });
});