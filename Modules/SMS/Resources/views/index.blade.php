@extends('layouts.main')

@section('header_title')
    SMS Listing
@endsection

@section('additional_head')
    <style>
        .default {
            position: inherit !important;
            left: 0 !important;
            opacity: 1 !important;
        }

        .title {
            font-weight: 500;
        }
        .broadcast-summary { margin-top: 20px; margin-bottom: 20px }
        .broadcast-summary th,
        .broadcast-summary td { border: 1px solid #d2d6de; text-align: center; padding: 5px; }
        table th, .dt-body-center { text-align: center; }

        #smsListTable tr:hover {
            /*cursor: -webkit-;*/
            cursor: pointer;
        }

        #pn_status_filter{
            position: relative;
            height: 100%;
            display: inline-block;
            min-width: 100pt;
        }
        #pn_status_filter > label{
            padding-left: 5px;
            padding-right: 5px;
        }

        .scrollStyle
        {
            overflow-x:auto;
        }

        table.dataTable,
        table.dataTable th,
        table.dataTable td {
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
        }

        div .dataTables_wrapper {
            box-sizing: content-box !important;
        }

    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            SMS Listing
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><i class="fa fa-comment-alt"></i> SMS Listing</li>
        </ol>
        <hr id="message-line" style="display: block;height: 2px;border: 0;border-top: 2px solid #0b93d5;">
        @if(Session::has('flash_message'))
            <div id="message-notification" class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> {!! Session::get('flash_message') !!}</h4>
            </div>
        @endif
        @if(Session::has('error_message'))
            <div id="error-notification" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-times"></i> {!! Session::get('error_message') !!}</h4>
            </div>
        @endif
    </section>


    <!-- Main content -->
    <section class="content" style="position: relative">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div id="pn_status_filter">

                    </div>
                    <table id="smsListTable" class="table table-bordered display table-responsive" cellspacing="0" width="100%" style="width: 100% !important;">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 7%">Index</th>
                                <th style="width: 15%">Created Date</th>
                                <th style="width: 20%">Message Content</th>
                                <th style="width: 15%">Sent Numbers</th>
                                <th style="width: 15%">Invalid Numbers</th>
                                <th style="width: 15%">Duplicate Numbers</th>
                                <th style="width: 13%">Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {
            var common = new IMSCommon();
            var smsListTable = $('#smsListTable');

            $(document).on('click', '#smsListTable tr', function(event) {
                if(!$(event.target).is('a') && !$(event.target).is('input[type=checkbox]')) {

                    var $a = $(this).find('a').first();

                    if (typeof $a != 'undefined' && $a.length) {
                        $a[0].click();
                    }
                }
            });

            // throw error rather than alert
            $.fn.dataTable.ext.errMode = 'throw';

            var oTable = smsListTable.dataTable({
                "serverSide": true,
                "scrollX": false,
                "pagingType": "simple_numbers",
                "paging": true,
                "processing": false,
                "order": [[ 1, 'desc' ]],
                "language": {
                    "processing": common.showLoading()
                },
                "fnPreDrawCallback": function() {
                    common.showLoading();
                    return true;
                },
                "fnDrawCallback": function() {
                    common.hideLoading();

                    $(".dataTables_scrollHeadInner").css({"width":"100%"});

                    $(".table ").css({"width":"100%"});

                    return true;
                },
                "initComplete": function( settings, json ) {
                    document.getElementById("smsListTable_filter").appendChild(document.getElementById('pn_status_filter'));
                    common.hideLoading();

                    var api = this.api();

                    this.api().columns([4]).every( function () {
                        var column = this;
                        $('<label>Status:</label>').appendTo( $('#pn_status_filter').empty());
                        var select = $('<select style="min-width: 70px"><option value=""></option></select>')
                            .appendTo( $('#pn_status_filter'))
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                var searchField = $("div.dataTables_filter input");
                                if (searchField.val()) {
                                    api.search(searchField.val());
                                }

                                column
                                    .search( val ? val : '', false, true)
                                    .draw();
                            });

                        select.append('<option value="SUCCESS">SUCCESS</option>');
                        select.append('<option value="FAILED">FAILED</option>');
                        select.append('<option value="ERROR">ERROR</option>');
                        select.append('<option value="TESTING">TESTING</option>');
                    });

                },
                "fixedColumns": true,
                "ajax": {
                    "url": "{{ url('sms','ajaxList') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (params) {
                        params._token = '{{ csrf_token() }}';
                    },
                    'error': function (jqXHR, exception) {
                        common.hideLoading();

                    },
                    statusCode: {
                        200: function() {
                            console.log('OK 200')
                        },
                        204: function() {
                            console.log('Empty 204')
                        },
                        400: function() {
                            console.log('Bad Request 400');
                            $('#error-notification').remove();
                            $('#message-line')
                                .after(
                                    '<div id="error-notification" class="alert alert-danger alert-dismissible">' +
                                    '   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                                    '   <h4><i class="icon fa fa-times"></i> [SMS ajax List] Bad request </h4>' +
                                    '</div>');
                        },
                        404: function() {
                            console.log('Data not found');
                            $('#error-notification').remove();
                            $('#message-line')
                                .after(
                                    '<div id="error-notification" class="alert alert-danger alert-dismissible">' +
                                    '   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                                    '   <h4><i class="icon fa fa-times"></i> [SMS ajax List] Data not found </h4>' +
                                    '</div>');
                        },
                        500: function() {
                            console.log('Internal server error 500');
                            $('#error-notification').remove();
                            $('#message-line')
                                .after(
                                    '<div id="error-notification" class="alert alert-danger alert-dismissible">' +
                                    '   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                                    '   <h4><i class="icon fa fa-times"></i> [SMS ajax List] Internal server error </h4>' +
                                    '</div>');
                        }
                    }
                },
                "columns": [
                    { "data": "index" },
                    { "data": "created_at" },
                    { "data": "content", render: $.fn.dataTable.render.text() },
                    { "data": "phones" },
                    { "data": "invalid_phones", render: $.fn.dataTable.render.text() },
                    { "data": "duplicate_phones" },
                    { "data": "status" }
                ],
                "columnDefs": [
                    {
                        'sortable': false,
                        "className": "text-center",
                        "targets": [0]
                    },
                    { "className": "text-center", "targets": [6] }
                ]
            });

            $("div.dataTables_filter input").unbind();

            $("div.dataTables_filter input").keyup( function (e) {
                if (e.keyCode == 13) {
                    oTable.fnFilter( this.value );
                }
            } );

        });

    </script>
@stop
