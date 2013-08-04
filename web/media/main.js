$(function () {

    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })

});

jQuery(function ($) {

    // Calendar Jquery UI
    $('.dateCalendar').datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 0
    })

    // Apply style to dropdowns
    //dropDownUi
    //$('.dropDownUi').selectmemu();

    function fixDiv() {
        var $cache = $('#navbar-example');
        if ($(window).scrollTop() > 20) {
            $cache.css({'position': 'fixed', 'top': '40px'});
            $cache.css({'width': '96.6%'});
        }
        else {
            $cache.css({'position': 'relative', 'top': 'auto'});
            $cache.css({'width': '100%'});
        }

    }

    $(window).scroll(fixDiv);
    fixDiv();
});