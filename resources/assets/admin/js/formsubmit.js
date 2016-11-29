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
                    titleVi:{ required: true },
                    titleEn:{	required: true},
                    textLink:{ required: true},
                    shrtCntVi:{ required: true},
                    shrtCntEn:{ required: true},
                    tourCntVi:{ required: true},
                    tourCntEn:{ required: true},
                    tourSchVi:{ required: true},
                    tourSchEn:{ required: true},
                    tourLthVi:{ required: true},
                    tourLthEn:{ required: true},
                    tourPrcVi:{ required: true},
                    tourPrcEn:{ required: true},
                    tourDescVi:{ required: true},
                    tourDescEn:{ required: true},
                },
                messages:
                {
                    titleVi:{ required: 'Nhập tiêu đề'},
                    titleEn:{	required: 'Nhập tiêu đề'},
                    textLink:{ required: 'Nhập text link'},
                    shrtCntVi:{ required: 'Nhập tóm tắt nội dung'},
                    shrtCntEn:{ required: 'Nhập tóm tắt nội dung'},
                    tourCntVi:{ required: 'Nhập nội dung'},
                    tourCntEn:{ required: 'Nhập nội dung'},
                    tourSchVi:{ required: 'Nhập kế hoạch'},
                    tourSchEn:{ required: 'Nhập kế hoạch'},
                    tourLthVi:{ required: 'Nhập thời gian'},
                    tourLthEn:{ required: 'Nhập thời gian'},
                    tourPrcVi:{ required: 'Nhập giá tour'},
                    tourPrcEn:{ required: 'Nhập giá tour'},
                    tourDescVi:{ required: 'Nhập mô tả tour'},
                    tourDescEn:{ required: 'Nhập mô tả tour'},
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
                tourCategory: $("#category").chosen().val(),
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
                error: function (xhr) {
                    var response = $.parseJSON(xhr.responseText);
                    var rslStr = "Hãy điền đầy đủ thông tin \n";
                    console.log(response);
                    console.log(Object.keys(response).length)
                    if(xhr.status == 422){
                        $.each(response, function(key, value) {
                            rslStr += value+"\n";
                        });
                        alert(rslStr);
                    }else{
                        if ($('#btnSubmit').text() == "Save"){
                            alert('Tạo mới bài viết lỗi. Vui lòng làm lại');
                        }else{
                            alert('Cập nhật bài viết lỗi. Vui lòng làm lại');
                        }
                    }
                }
            });

            return false;
        }

        $('form#tourEditorForm').on("click", function() {
            $(this).find('p.error').remove();
        })
    }

    if ($("#newsEditorForm").length) {
        /**/
        /* add admin form */
        /**/
        /* validate the add admin form fields */

        $("#newsEditorForm").each(function(){
            $(this).validate(  /*feedback-form*/{
                onkeyup: false,
                onfocusout: false,
                errorElement: 'p',
                errorLabelContainer: $(this).children(".alert.alert-danger").children(".message"),
                rules:
                {
                    titleVi:{ required: true },
                    titleEn:{	required: true},
                    textLink:{ required: true},
                    shrtCntVi:{ required: true},
                    shrtCntEn:{ required: true},
                },
                messages:
                {
                    titleVi:{ required: 'Nhập tiêu đề'},
                    titleEn:{	required: 'Nhập tiêu đề'},
                    textLink:{ required: 'Nhập text link'},
                    shrtCntVi:{ required: 'Nhập tóm tắt nội dung'},
                    shrtCntEn:{ required: 'Nhập tóm tắt nội dung'},
                },
                invalidHandler: function()
                {
                    $(this).children(".alert.alert-danger").slideDown('fast');
                    $("#feedback-form-success").slideUp('fast');
                },
                submitHandler: function(form)
                {
                    $(form).children(".alert.alert-danger").slideUp('fast');
                    news_submit_handler($(form), $(form).children(".tour_server_response") );
                }
            });
        })

        /* Ajax, Server response */
        var news_submit_handler =  function (form, wrapper){
            var $wrapper = $(wrapper); //this class should be set in HTML code
            $wrapper.css("display","block");

            var formData = new FormData();

            var data = {
                newsId: $('#newsId').val(),
                newsTitleVi: $('#titleVi').val(),
                newsTitleEn: $('#titleEn').val(),
                newsTextLink: $('#textLink').val(),
                newsCategory: $("#category").chosen().val(),
                newsHot: $('#newsHot ').is(":checked") == true ? "Y" : "N",
                newsShrtCntVi: $('#shrtCntVi').val(),
                newsShrtCntEn: $('#shrtCntEn').val(),
                newsCntVi: CKEDITOR.instances.newsCntVi.getData(),
                newsCntEn: CKEDITOR.instances.newsCntEn.getData(),
                newsKeywordVi: $('#keywordVi').val(),
                newsKeywordEn: $('#keywordEn').val(),
                formAction: $('#btnSubmit').text(),
                rpvImg: ($("#rpvImg"))[0].files[0],
                rpvTxtLink: $('#txtRpvImgLnk').val(),
                _token: $('meta[name="csrf-token"]').attr('content'),
                header: $('meta[name="csrf-token"]').attr('content'),
            };

            for( dt in data){
                formData.append(dt, data[dt]);
            }

            $.ajax({
                type: 'POST',
                url: '/admin/newsEditor',
                data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                dataType: 'json',
                success: function (response) {
                    alert(response.Content);
                    if ($('#btnSubmit').text() == "Save"){
                        window.location = '/admin/news-edit/'+response.newsId;
                    }else{
                        location.reload();
                    }
                },
                error: function (xhr) {
                    var response = $.parseJSON(xhr.responseText);
                    var rslStr = "Hãy điền đầy đủ thông tin \n";
                    console.log(response);
                    console.log(Object.keys(response).length)
                    if(xhr.status == 422){
                        $.each(response, function(key, value) {
                            rslStr += value+"\n";
                        });
                        alert(rslStr);
                    }else{
                        if ($('#btnSubmit').text() == "Save"){
                            alert('Tạo mới bài viết lỗi. Vui lòng làm lại');
                        }else{
                            alert('Cập nhật bài viết lỗi. Vui lòng làm lại');
                        }
                    }
                }
            });

            return false;
        }

        $('form#newsEditorForm').on("click", function() {
            $(this).find('p.error').remove();
        })
    }

    //tour update in list page
    $("#tbNewsList").unbind('click');
    $("#tbNewsList").on("click", "#newsSave", function () {
        var trObject = $(this).parent().parent('tr');
        var data = new FormData();
        data.append('newsId', $(this).attr('item-data'));
        data.append('newsHot', $(trObject.find('input')[0]).is(':checked') == true ? "Y": "N");
        data.append('newsAct', $(trObject.find('input')[1]).is(':checked') == true ? "Y": "N");
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        data.append('header', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            type: 'POST',
            url: '/admin/newsUpdate',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            dataType: 'json',
            success: function (response) {
                alert(response.Content);
            },
            error: function (response) {
                alert("Lỗi hệ thống, vui lòng thử lại.");
            }
        });

        return false;
    });
});