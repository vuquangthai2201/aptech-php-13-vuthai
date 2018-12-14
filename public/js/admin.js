$('.active-click').on('click', function(){
    var id = $(this).attr('id');
    var tt = '#' + id;
    var route = $('.route_user').val();
    $.ajax({
        url: route,
        type: 'GET',
        dataType: 'html',
        data: {
            id: id,
        },
        success: function(data){
            $(tt).html(data);
        },
        error: function(){
            alert('Error when change active user');
        }
    });
});

$('.status-click').on('click', function(){
    var id = $(this).attr('id');
    var tt = '#' + id;
    var route = $('.route_order').val();
    $.ajax({
        url: route,
        type: 'GET',
        dataType: 'html',
        data: {
            id: id,
        },
        success: function(data){
            $(tt).html(data);
        },
        error: function(){
            alert('Error when change status order');
        }
    });
});

$('.chart-click').on('click', function() {
    $('.chart-click').removeClass('active');
    $(this).addClass('active');
    var value_id = $(this).attr('id');
    if (value_id == 'years') {
        $('.years').show();
        $('.months').hide();
    } else {
        $('.months').show();
        $('.years').hide();
    }
});

var getLang = $.parseJSON($('input:hidden[name="getLangugue"]').val());

$('.click-confirm-del').on('submit', function() {
    return confirm(getLang['are_u_sure']);
});

$('.click-submit-cat').on('submit', function() {
    return confirm(getLang['admin']['will_u_del_sub_cat']);
});

$('.select-category').on('change', function (){
    var id = $(this).val();
    var route_category = $('.route_category').val();
    if (id == "") {
        $('.sub-category').html('');
    } else {
        $.ajax({
            url: route_category,
            type: 'GET',
            dataType: 'html',
            data: {
              id: id,
            },
            success: function(data){
                $('.sub-category').html(data);
            },
            error: function(){
                alert('Error when select category');
            }
        });
    }
});

$('input:radio[name="strap"]').change(function() {
    var route_strap = $('.route_strap').val();
    $.ajax({
        url: route_strap,
        type: 'GET',
        dataType: 'html',
        data: {
          value: $(this).val(),
        },
        success: function(data){
            $('.data-strap').html(data);
        },
        error: function(){
            alert('Error when change strap type');
        }
    });
});

$('input:radio[name="skin"]').change(function() {
    var route_skin = $('.route_skin').val();
    $.ajax({
        url: route_skin,
        type: 'GET',
        dataType: 'html',
        data: {
          value: $(this).val(),
        },
        success: function(data){
            $('.data-skin').html(data);
        },
        error: function(){
            alert('Error when change skin type');
        }
    });
});

$('input:radio[name="energy"]').change(function() {
    var route_energy = $('.route_energy').val();
    $.ajax({
        url: route_energy,
        type: 'GET',
        dataType: 'html',
        data: {
          value: $(this).val(),
        },
        success: function(data){
            $('.data-energy').html(data);
        },
        error: function(){
            alert('Error when change energy type');
        }
    });
});
