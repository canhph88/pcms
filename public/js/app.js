$(document).ready(

    function($) {

        // $ = global.jquery;

        // $ = window.$ = window.jQuery = require('jquery');

        // $("#message-bar").fadeTo(2000, 500).slideUp(500, function(){
        //     $("#message-bar").slideUp(500);
        // });

        $("#message-bar").slideUp(3000);

        $(".table-row").click(function() {
            window.document.location = $(this).data("href");
        });

        $("#checkAll").click(function () {
            $(".ckbox-item").prop('checked', $(this).prop('checked'));
            // $(this).removeAttribute('checked');
        });

        var items = $('.ckbox-item');

        $.each(items, function (index, item) {
            $(item).click(function () {
                if ($(this).prop('checked') == false && $('#checkAll').prop('checked') == true) {
                    // alert($(this).prop('checked'));
                    $('#checkAll').prop('checked', $(this).prop('checked'));
                }
            });
        });

    }
);