@extends('layouts.main')

@section('header_title')
    Create SMS
@endsection

@section('additional_head')
    <style>
        .default {
            position: inherit !important;
            left: 0 !important;
            opacity: 1 !important;
        }

        .multi-select {
            width: 100%;
            min-height: 100px;
            border: 1px solid #cccccc
        }

        .multi-select ul {
            list-style: none;
            margin: 0;
            padding: 0 5px 5px;
            overflow: auto;
        }

        .multi-select li {
            background-color: #f39c12;
            border-color: #367fa9;
            padding: 1px 10px;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            float: left;
            margin-right: 5px;
            margin-top: 5px;
            display: list-item;
            text-align: -webkit-match-parent;
            white-space: nowrap;
            -webkit-user-select: none;
        }

        .multi-select li .select2-selection__choice__remove {
            color: rgba(255, 255, 255, .7);
        }

        .dataTables_scrollHeadInner table {
            width: 100% !important;
        }

        .dataTables_scrollHeadInner {
            width: 100% !important;
        }

        table th, .dt-body-center { text-align: center; }

        .custom-right {
            float:right;
            margin-right: 20px;
        }

        #sms-content {
            resize: none;
        }
    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Send SMS
{{--            <small>{{ $br->incident_id }}</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{!! url('sms') !!}"><i class="fa fa-comment-alt"></i> SMS Listing</a></li>
            <li class="breadcrumb-item"> Send SMS</li>
        </ol>
        <hr style="display: block;height: 2px;border: 0;border-top: 2px solid #0b93d5;">
        @if(Session::has('flash_message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> {!! Session::get('flash_message') !!}</h4>
            </div>
        @endif
        @if(Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> {!! Session::get('error_message') !!}</h4>
            </div>
        @endif
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <form method="post" action="{{ url('sms/send') }}" id="smsSendForm" name="smsSendForm" enctype='multipart/form-data'>
                        {!! Form::token() !!}
                        <div class="box-header">
                            <h3 class="box-title">Input SMS</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="sms-type">Send Type:</label>
                                <div class="col-sm-8">
                                    <div class="form-group row">
                                        <div class="radio col-sm-4">
                                            <input name="sms-type" type="radio" id="send-input" value="0" @if(!old('sms-type')) checked @endif>
                                            <label for="send-input">Input numbers</label>
                                        </div>
                                        <div class="radio col-sm-4">
                                            <input name="sms-type" type="radio" id="send-file" value="1" @if(old('sms-type')) checked @endif>
                                            <label for="send-file">Upload file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" id="input-row">
                                <label class="col-sm-2 col-form-label" for="phones">Phone numbers<span class="text-danger">*</span>:</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="phones" id="phones" placeholder='Phone numbers seperated by ","' type="text" value="{{ old('phones') }}" minlength="3" maxlength="160" />
                                    <p class="help-block text-warning">
                                        {{ $errors->first('phones') }}
                                    </p>
                                </div>

                            </div>
                            <div class="form-group row" id="file-row">
                                <label for="phone-file" class="col-sm-2 col-form-label">Phones file<span class="text-danger">*</span>:</label>
                                <div id="attachmentContain" class="col-sm-8 parentAttachment">
                                    <div class="attachment-container">
                                        <input type="file" name="phone-file" id="phone-file" class="fileAttachmentAddMore" >
                                        <p class="help-block text-warning" style="margin-bottom: 23px">
                                            {{ $errors->first('phone-file') }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="sms-content">Content<span class="text-danger">*</span>:</label>
                                <div class="col-sm-10 col-md-8">
                                    <textarea class="form-control" name="sms-content" id="sms-content" rows="3" placeholder="Please use up to 160 characters" >{{ old('sms-content') }}</textarea>
                                    <p class="help-block text-warning">{{ $errors->first('sms-content') }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                            </div>
                        </div>
                        <hr style="display: block;height: 2px;border: 0;border-top: 2px solid #0b93d5;">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-2 float-right">
                                    <button id="submit-btn" type="submit" class="btn bg-olive btn-block">
                                        <i class="fa fa-save"></i> Send
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        var inputRow = $('#input-row');
        var fileRow = $('#file-row');

        var setSentType = function() {

            if ($("input[name='sms-type']:checked").val() == '0') {
                $(fileRow).hide();
                $('#phone-file').val('');
                $(inputRow).show();
            }
            else if ($("input[name='sms-type']:checked").val() == '1') {
                $(inputRow).hide();
                $('#phones').val('');
                $(fileRow).show();
            }

        };

        $(document).ready(function () {

            setSentType();

            $('#submit-btn').click(function() {
                $('#smsSendForm').submit();
                $(this).attr('disabled','disabled');
            });

            $('input:radio[name=sms-type]').change(function () {
                setSentType();
            });

        });
    </script>

@endsection
