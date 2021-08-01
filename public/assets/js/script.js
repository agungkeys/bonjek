// // Prevent closing from click inside dropdown
//     $(document).on('click', '.dropdown-menu', function (e) {
//       e.stopPropagation();
//     });

// preload
$(document ).ready(function() {
  const formatRupiah = (money) => {
     return new Intl.NumberFormat('id-ID',
       { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }
     ).format(money);
  }
});
$(window).on('load', function () {
    $('#preloader').fadeOut('200', function () {
        $(this).remove();
    });
});

// add padding top to show content behind navbar
if ($('.app-header.fixed-top').length > 0) { // check if element exists
    $('body').css('padding-top', $('.app-header').outerHeight() + 'px')
}



// Add class based on scrollup/down to detect scroll direction
var last_scroll_top = 0;
$(window).on('scroll', function(){
    if( $(this).scrollTop() > 7 ){
        scroll_top = $(this).scrollTop();

        // detect scroll
        if(scroll_top < last_scroll_top) {
            $('body').removeClass('scrolling-down').addClass('scrolling-up');
        }
        else {
            $('body').removeClass('scrolling-up').addClass('scrolling-down');

        }
        last_scroll_top = scroll_top;

    } else {
        $('body').removeClass('scrolling-down scrolling-up');
    }
});



$('.js-check :radio').change(function () {
    var check_attr_name = $(this).attr('name');
    if ($(this).is(':checked')) {
        $('input[name='+ check_attr_name +']').closest('.js-check').removeClass('active');
        $(this).closest('.js-check').addClass('active');
       // item.find('.radio').find('span').text('Add');

    } else {
        item.removeClass('active');
        // item.find('.radio').find('span').text('Unselect');
    }
});


$('.js-check :checkbox').change(function () {
    var check_attr_name = $(this).attr('name');
    if ($(this).is(':checked')) {
        $(this).closest('.js-check').addClass('active');
       // item.find('.radio').find('span').text('Add');
    } else {
        $(this).closest('.js-check').removeClass('active');
        // item.find('.radio').find('span').text('Unselect');
    }
});


//add a function to jQuery so we can call it on our jQuery collections
$.fn.capitalize = function () {

    //iterate through each of the elements passed in, `$.each()` is faster than `.each()
    $.each(this, function () {

        //split the value of this input by the spaces
        var split = this.value.split(' ');

        //iterate through each of the "words" and capitalize them
        for (var i = 0, len = split.length; i < len; i++) {
            split[i] = split[i].charAt(0).toUpperCase() + split[i].slice(1);
        }

        //re-join the string and set the value of the element
        this.value = split.join(' ');
    });
    return this;
};
