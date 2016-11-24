/**
 * Created by HaiLong on 10/10/2016.
 */
$(document).ready(function() {

    //login
    if ($("#login-form").length) {
        /**/
        /* add admin form */
        /**/
        /* validate the add admin form fields */

        $("#login-form").each(function(){
            $(this).validate(  /*feedback-form*/{
                onkeyup: false,
                onfocusout: false,
                errorElement: 'p',
                errorLabelContainer: $(this).children(".alert.alert-danger").children(".message"),
                rules:
                {
                    username:{	required: true},
                    password:{	required: true},
                },
                messages:
                {
                    username:{	required: 'Vui lòng nhập tên đăng nhập'},
                    password:{	required: 'Vui lòng nhập mật khẩu!.'},
                },
                invalidHandler: function()
                {
                    $(this).children(".alert.alert-danger").slideDown('fast');
                    $("#feedback-form-success").slideUp('fast');
                },
                submitHandler: function(form)
                {
                    $(form).children(".alert.alert-danger").slideUp('fast');
                    login_submit_handler($(form), $(form).children(".form-response") );
                }
            });
        })

        /* Ajax, Server response */
        var login_submit_handler =  function (form, wrapper){
            var $wrapper = $(wrapper); //this class should be set in HTML code
            $wrapper.css("display","block");
            var data = {
                username: form.children().children('#username').val(),
                password: form.children().children('#password').val(),
                remember: form.children().children('#remember:checked').val(),
                _token: $('meta[name="csrf-token"]').attr('content'),
            };
            // send data to server
            $.post("/admin/sigIn", data, function(response) {
                if(response.info == 'Success'){
                    confirm(response.Content);
                    location.replace("/admin");
                } else {
                    confirm(response.Content);
                    $wrapper.append('<span class="help-block error-alert"> ' + response.Content + '</span>');
                }
            }, "json").fail(function (response) {
                var mess = JSON.parse(response.responseText);
                console.log(mess);
                for (var idx in mess){
                    $wrapper.append('<span class="help-block error-alert"> *' + mess[idx] + '</span>');
                }
            });

            return false;
        }

        $('form#admin-register').on("click", function() {
            $(this).find('p.error').remove();
        })
    }

    //user register
    if ($("#admin-register").length) {
        /**/
        /* add admin form */
        /**/
        /* validate the add admin form fields */

        $("#admin-register").each(function(){
            $("#admin-register").validate(  /*feedback-form*/{
                onkeyup: false,
                onfocusout: false,
                errorElement: 'p',
                errorLabelContainer: $(this).children(".alert.alert-danger").children(".message"),
                rules:
                {
                    username:{	required: true},
                    password:{	required: true},
                    email:{ required:true,	email: true }
                },
                messages:
                {
                    username:{	required: 'Vui lòng nhập tên đăng nhập'},
                    password:{	required: 'Vui lòng nhập mật khẩu!.'},
                    email:{	required: 'Vui lòng nhập email.',
                        email: 'Vui lòng nhập chính xác địa chỉ email.'	},
                },
                invalidHandler: function()
                {
                    $(this).parent().children().children(".alert.alert-danger").slideDown('fast');
                },
                submitHandler: function(form)
                {
                    $(form).children(".alert.alert-danger").slideUp('fast');
                    register_submit_handler($(form), $(form).children().children(".form-response") );
                }
            });
        })

        /* Ajax, Server response */
        var register_submit_handler =  function (form, wrapper){
            var $wrapper = $(wrapper); //this class should be set in HTML code
            $wrapper.css("display","block");
            var data = {
                username: form.children().children().children('#username').val(),
                password: form.children().children().children('#password').val(),
                email: form.children().children().children('#email').val(),
                role: form.children().children().children().children('#role:checked').val(),
                _token: $('meta[name="csrf-token"]').attr('content'),
            };
            // send data to server
            $.post("/admin/addUser", data, function(response) {
                if(response.info == 'Success'){
                    confirm(response.Content);
                    $(form)[0].reset();
                } else {
                    confirm(response.Content);
                }
            }, "json").fail(function (response) {
                var mess = JSON.parse(response.responseText);
                for (var idx in mess){
                    $wrapper.append('<span class="help-block error-alert"> *' + mess[idx] + '</span>');
                }
            });

            return false;
        }

        $('form#admin-register').on("click", function() {
            $(this).find('p.error').remove();
        })
    }

    //tour update in list page
    $("#tbTourList").unbind('click');
    $("#tbTourList").on("click", "#tourSave", function () {
        var trObject = $(this).parent().parent('tr');
        var data = new FormData();
        data.append('tourId', $(this).attr('item-data'));
        data.append('tourRpv', $(trObject.find('input')[0]).is(':checked') == true ? "Y": "N");
        data.append('tourPrm', $(trObject.find('input')[1]).is(':checked') == true ? "Y": "N");
        data.append('tourAct', $(trObject.find('input')[2]).is(':checked') == true ? "Y": "N");
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            type: 'POST',
            url: '/admin/tourUpdate',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                alert(response.Content);
            },
            error: function (response) {
                alert(response.Content);
            }
        });

        return false;
    });

    //Tour Submit form
    if ($("#tourEditorForm").length) {
        /**/
        /* add admin form */
        /**/
        /* validate the add admin form fields */

        $("#tourEditorForm").each(function(){
            $(this).validate(  /*feedback-form*/{
                onkeyup: false,
                onfocusout: false,
                errorElement: 'p',
                errorLabelContainer: $(this).children(".alert.alert-danger").children(".message"),
                rules:
                {
                    tourTitleVi:{ required: true },
                    tourTitleEn:{	required: true},
                    tourTextLink:{ required: true},
                    tourShrtCntVi:{ required: true},
                    tourShrtCntEn:{ required: true},
                    tourCntVi:{ required: true},
                    tourCntEn:{ required: true},
                    tourScheduleVi:{ required: true},
                    tourScheduleEn:{ required: true},
                    tourLengthVi:{ required: true},
                    tourLengthEn:{ required: true},
                    tourPriceVi:{ required: true},
                    tourPriceEn:{ required: true},
                    tourDescVi:{ required: true},
                    tourDescEn:{ required: true},
                    tourKeywordVi:{ required: true},
                    tourKeywordEn:{ required: true},
                },
                messages:
                {
                    tourTitleVi:{ required: 'Nhập tiêu đề'},
                    tourTitleEn:{	required: 'Nhập tiêu đề'},
                    tourTextLink:{ required: 'Nhập text link'},
                    tourShrtCntVi:{ required: 'Nhập tóm tắt nội dung'},
                    tourShrtCntEn:{ required: 'Nhập tóm tắt nội dung'},
                    tourCntVi:{ required: 'Nhập nội dung'},
                    tourCntEn:{ required: 'Nhập nội dung'},
                    tourScheduleVi:{ required: 'Nhập kế hoạch'},
                    tourScheduleEn:{ required: 'Nhập kế hoạch'},
                    tourLengthVi:{ required: 'Nhập thời gian'},
                    tourLengthEn:{ required: 'Nhập thời gian'},
                    tourPriceVi:{ required: 'Nhập giá tour'},
                    tourPriceEn:{ required: 'Nhập giá tour'},
                    tourDescVi:{ required: 'Nhập mô tả tour'},
                    tourDescEn:{ required: 'Nhập mô tả tour'},
                    tourKeywordVi:{ required: 'Nhập Từ khóa'},
                    tourKeywordEn:{ required: 'Nhập Từ khóa'},
                },
                invalidHandler: function()
                {
                    $(this).children(".alert.alert-danger").slideDown('fast');
                    $("#feedback-form-success").slideUp('fast');
                },
                submitHandler: function(form)
                {
                    $(form).children(".alert.alert-danger").slideUp('fast');
                    tour_submit_handler($(form), $(form).children(".tour_server_response") );
                }
            });
        })

        /* Ajax, Server response */
        var tour_submit_handler =  function (form, wrapper){
            var $wrapper = $(wrapper); //this class should be set in HTML code
            $wrapper.css("display","block");

            var formData = new FormData();
            var imgList = "";
            var imgIndex = $('.img-thumb-layout').find('.img-item');
            for (var i = 0; i < imgIndex.length; i++) {
                var MyIndexValue = $(imgIndex[i]).find('img').attr('src');
                imgList += MyIndexValue+",";
            }

            var data = {
                tourId: $('#tourId').val(),
                tourTitleVi: $('#titleVi').val(),
                tourTitleEn: $('#titleEn').val(),
                tourTextLink: $('#textLink').val(),
                tourLocation: $("#province").chosen().val(),
                tourFrt: $('#tourFtr ').is(":checked") == true ? "Y" : "N",
                tourRcm: $('#tourRcm ').is(":checked") == true ? "Y" : "N",
                tourShrtCntVi: $('#shrtCntVi').val(),
                tourShrtCntEn: $('#shrtCntEn').val(),
                tourCntVi: CKEDITOR.instances.tourCntVi.getData(),
                tourCntEn: CKEDITOR.instances.tourCntEn.getData(),
                tourScheduleVi: CKEDITOR.instances.tourSchVi.getData(),
                tourScheduleEn: CKEDITOR.instances.tourSchEn.getData(),
                imgLinkList: imgList,
                imgUploadListCnt: $('#uploader').plupload('getFiles').length,
                tourLengthVi: $('#tourLthVi').val(),
                tourLengthEn: $('#tourLthEn').val(),
                tourPriceVi: $('#tourPrcVi').val(),
                tourPriceEn: $('#tourPrcEn').val(),
                tourPrmPrice: $('#tourPrm').val(),
                tourKeywordVi: $('#keywordVi').val(),
                tourKeywordEn: $('#keywordEn').val(),
                tourDescVi: $('#tourDescVi').val(),
                tourDescEn: $('#tourDescEn').val(),
                formAction: $('#btnSubmit').text(),
                rpvImg: ($("#rpvImg"))[0].files[0],
                rpvTxtLink: $('#txtRpvImgLnk').val(),
                _token: $('meta[name="csrf-token"]').attr('content'),
                header: $('meta[name="csrf-token"]').attr('content'),
            };

            for( dt in data){
                formData.append(dt, data[dt]);
            }

            if($('#uploader').plupload('getFiles').length > 0){
                for (var i =0; i < $('#uploader').plupload('getFiles').length; i++){
                    formData.append('imgUploadList'+(i+1),$('#uploader').plupload('getFiles')[i].getSource().getSource())
                }
            }

            $.ajax({
                type: 'POST',
                url: '/admin/tourEditor',
                data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                dataType: 'json',
                success: function (response) {
                    alert(response.Content);
                    if ($('#btnSubmit').text() == "Save"){
                        window.location = '/admin/tour-edit/'+response.postId;
                    }else{
                        location.reload();
                    }
                },
                error: function (response) {
                    alert(response.Content);
                }
            });

            return false;
        }

        $('form#tourEditorForm').on("click", function() {
            $(this).find('p.error').remove();
        })
    }

});