/**
 * Created by HaiLong on 9/5/2016.
 */
"use strict"; // start of use strict
$(document).ready(function() {
    popup_tour_init();

    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //     }
    // });

    $('#tourRate').on('rating.change', function(event, value) {
        $('#rateValue').val(value);
    });
    $('#tourRate').rating('update', 5);

    $('#tourBookingBtn').on('click', function () {
        $('#tour-booking-form').submit();
    })
    /**/
    /* tour booking form */
    /**/
    /* validate the tour booking form fields */
    $("#tour-booking-form").validate(  /*feedback-form*/{
        onkeyup: false,
        onfocusout: false,
        errorElement: 'p',
        errorLabelContainer: $(this).parent().children(".alert.alert-danger").children(".message"),
        rules:
        {
            custName:{ required: true },
            custEmail:{	required: true,	email: true	},
            custPhone:{ required: true},
            custAddress:{ required: true},
        },
        messages:
        {
            custName:{ required: 'Please enter your name'},
            custEmail:{	required: 'Please enter your email address',
                email: 'Please enter a VALID email address'	},
            custPhone:{ required: 'Please enter your phone number'},
            custAddress:{ required: 'Please enter your address'},
        },
        invalidHandler: function()
        {
            $(this).parent().children().slideDown('fast');
        },
        submitHandler: function(form)
        {
            $(form).parent().children(".alert.alert-danger").slideUp('fast');
            var $form = $(form).ajaxSubmit();
            submit_handler($form, $(form).children(".booking_server_response") );
        }
    });

    /* Ajax, Server response */
    var submit_handler =  function (form, wrapper){

        var $wrapper = $(wrapper); //this class should be set in HTML code
        $wrapper.css("display","block");
        var data = {
            id: form.children('#tourID').val(),
            name: form.children().children('#custName').val(),
            tel: form.children().children('#custPhone').val(),
            email: form.children().children('#custEmail').val(),
            adult: form.children().children('#adultQty').val(),
            child: form.children().children('#childQty').val(),
            address: form.children().children('#custAddress').val(),
            depart: form.children().children().children('#departDate').val(),
            return: form.children().children().children('#returnDate').val(),
            content: form.children().children('#custContent').val(),
            _token: $('meta[name="csrf-token"]').attr('content'),
        };
        // send data to server
        $.post("/tourBooking", data, function(response) {
            if(response.info == 'Success'){
                $wrapper.addClass("message message-success").append('<div role="alert" class="alert alert-success alt alert-dismissible fade in"><button type="button" data-dismiss="alert" aria-label="Close" class="close"></button><i class="alert-icon flaticon-suntour-check"></i><strong>Success!</strong><br>' + response.Content + '</div>');
                $wrapper.delay(3000).slideUp(300, function(){
                    $(this).removeClass("message message-success").text("").fadeOut(500);
                    $wrapper.css("display","none");
                    $(".tour-popup").removeClass("open");
                });
                $(form)[0].reset();

            } else {
                $wrapper.addClass("message message-error").append('<div role="alert" class="alert alert-warning alt alert-dismissible fade in"><button type="button" data-dismiss="alert" aria-label="Close" class="close"></button><i class="alert-icon flaticon-warning"></i><strong>Error!</strong><br>' + response.Content + '</div>');
                $wrapper.delay(5000).hide(500, function(){
                    $(this).removeClass("message message-success").text("").fadeIn(500);
                    $wrapper.css("display","none");
                });
            }
        }, "json");

        return false;
    }

    $('form.booking-form').children().on("click", function() {
        $(this).find('p.error').remove();
    })
});
// login popup
function popup_tour_init(){
    $("#tour-booking").on("click", function() {
        $(".tour-popup").addClass("open");
    })

    $(".tour-popup .close-button").on("click", function() {
        $(".tour-popup").removeClass("open");
    })
};
