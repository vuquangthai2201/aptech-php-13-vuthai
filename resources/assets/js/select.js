$(".selection-1").select2({
    minimumResultsForSearch: 20,
    dropdownParent: $('#dropDownSelect1')
});

function addcart(id_product){
    try {
        var route_name = document.getElementById(id_product).value;
        $.ajax({
            url: route_name,
            type: 'GET',
            async: false,
            dataType: 'html',
            data: {
               id_product:id_product
            },
            success: function(data){
                $('.header-icons-noti').html(data);
            },
            error: function(){
                alert('Có lỗi khi thêm sản phẩm');
            }
        });
        changecart(id_product);
    } catch (error) {
        alert(error);
    }
}

function changecart(id_product){
    var route = document.getElementById('changecart-'+id_product).value;
    $.get(route, function(data){
        $('.change-cart').html(data);
    });
}

function change(id_product)
{
    var value = $('#quantity-'+id_product).val();
    if (value == false || value < 0 )
    {
        alert('Input again');
        return false;
    }
    $("#form-quantity-"+id_product).submit();
}

function common(name){
    var common = $('input:checkbox[name="' + name + '[]"]');
    common.on('change', function(e){
        if($(this).attr('id')!= name + '-all')
        {
            if($(this).is(':checked'))
                $('#' + name + '-all').prop('checked', false);

            else
            {
                var le2 = $(':checkbox[name="' + name + '[]"]')
                    .filter(':checked')
                    .not('#' + name + '-all').length;
                if (le2 == 0)
                  $('#' + name + '-all').prop('checked', true);

            }
        }
        else
        {
            if($(this).is(':checked')){
                common.not($(this)).prop('checked', false);
            } else {
                common.not($(this)).prop('checked', false);
                $(this).prop('checked', true);
            }
        }
      $('.filter-form').submit();
    });
}
common('cat');
common('skin');
common('strap');
common('energy');

$('#filter_price').on('click', function(){
    $('.filter-form').submit();
});

$('.selection-2').on('change', function(){
    document.getElementById("sort").innerHTML = "<input type='hidden' name='sort' value='"+$(this).val()+"' />" ;
    $('.filter-form').submit();
});

$('#click-logout').on('click', function(){
    $('#logout-form').submit();
});

/* Rating Product */
$(document).ready(function(){
    $('#stars li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10);
        $(this).parent().children('li.star').each(function(e){
            if (e < onStar) {
                $(this).addClass('hover');
            }
            else {
                $(this).removeClass('hover');
            }
        });
    }).on('mouseout', function(){
        $(this).parent().children('li.star').each(function(e){
            $(this).removeClass('hover');
        });
    });
    $('#stars li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10);
        var stars = $(this).parent().children('li.star');
        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }
        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }
        var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
        var msg = "";
        if (ratingValue > 1) {
            msg = "Thanks! You rated this " + ratingValue + " stars.";
        }
        else {
            msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
        }
        responseMessage(msg);
    });
});
function responseMessage(msg) {
    $('.success-box').fadeIn(200);
    $('.success-box div.text-message').html("<span>" + msg + "</span>");
}
$.fn.stars = function() {
    return $(this).each(function() {
        var rating = $(this).data("rating");
        var numStars = $(this).data("numStars");
        var fullStar = new Array(Math.floor(rating + 1)).join('<i class="fa fa-star"></i>');
        var halfStar = ((rating % 1) !== 0) ? '<i class="fa fa-star-half-empty"></i>': '';
        var noStar = new Array(Math.floor(numStars + 1 - rating)).join('<i class="fa fa-star-o"></i>');
        $(this).html(fullStar + halfStar + noStar);
    });
}
$('.stars').stars();
 /* Ajax Rating */
$(function () {
    $('#submit-rating').on('click', function (e) {
        e.preventDefault();
        var route = $('.rating-name').val();
        var product_id = $('.product-id').val();
        var user_id = $('.user-id').val();
        var content = $('#content-form-rating').val();
        var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
        if (content == "") {
            alert('Please input content');
            return false;
        } else {
            if (ratingValue < 1)
            {
                alert('Please rate product');
                return false;
            } else {
                $.ajax({
                    type: 'GET',
                    url: route,
                    data: {
                        product_id: product_id,
                        user_id: user_id,
                        content: content,
                        point: ratingValue,
                    },
                    success: function (data) {
                       $('.ajax-content').before(data);
                       $('.rating-widget').hide();
                       changerating(product_id);
                    },
                    error: function(){
                        alert('Error while rating');
                    }
                });
            }
        }
    });
});
function changerating(product_id){
    var route_change_rating = $('.route-change-rating').val();
    $.ajax({
        type: 'GET',
        url: route_change_rating,
        data: {
            product_id: product_id,
        },
        success: function (data) {
           $('.placeholder').html(data);
        },
        error: function(){
            alert('Error while replace number review');
        }
    });
}

function validatePassword(){
    if($("#password_profile").val() != $("#confirm_password_profile").val()) {
        $('#confirm_password_profile')[0].setCustomValidity("Passwords Don't Match");
    } else {
        $('#confirm_password_profile')[0].setCustomValidity('');
    }
}
$("#password_profile").on('change', function(){
    if ($("#password_profile").val() != null){
        $("#password_profile").attr('require', true);
        $("#password_profile").attr('minlength', 6);
        validatePassword();
    }
});
$("#confirm_password_profile").on('keyup', function(){
    validatePassword();
});
