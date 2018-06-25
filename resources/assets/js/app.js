
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });


$(document).ready(

    function($) {

        // $ = global.jquery;

        // $ = window.$ = window.jQuery = require('jquery');

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
                if ($(item).attr('checked', 'false')) {
                    $('#checkAll').prop('checked', 'false');
                }
            });
        });

    }
);
