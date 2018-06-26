@extends('layouts.main')

@section('header_title')
    View SMS
@endsection

@section('additional_head')
    <style>
        table th, .dt-body-center { text-align: center; }
        .wrap-text {
            overflow-wrap:break-word;
        }
    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            View SMS
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{!! url('sms') !!}"><i class="fa fa-comment-alt"></i> SMS Listing</a></li>
            <li class="breadcrumb-item"> View</li>
            <li class="breadcrumb-item active"><a href="{!! url('sms', $sms->id) !!}/show"> {{ $sms->id }}</a></li>
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
                    <div class="box-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#detail" role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span class="hidden-xs-down">Detail</span></a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="detail" role="tabpanel">
                                <div class="pad">
                                    <div class="row" style="margin-top: 20px">
                                        <label class="col-sm-3"><b>SMS created date: </b></label>
                                        <div class="col-sm-9">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $sms->created_at)->setTimezone(config('app.display_timezone'))->toDateTimeString() }}
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 20px">
                                        <label class="col-sm-3"><b>SMS Content: </b></label>
                                        <div class="col-sm-9" style="white-space: pre-wrap">{{ html_entity_decode($sms->content) }}</div>
                                    </div>
                                    <div class="row" style="margin-top: 20px">
                                        <label class="col-sm-3"><b>SMS Status: </b></label>
                                        <div class="col-sm-9">
                                            {{--{{ \App\Core\Libraries\Utilconstant::INCIDENT_STATUS[$sms->status] }}--}}
                                            {{ !empty($sms->status) ? html_entity_decode($sms->status) : 'N/A' }}
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 20px">
                                        <label class="col-sm-3"><b>Returned Message: </b></label>
                                        <div class="col-sm-9">
                                            <p>{{ !empty($sms->returned_msg) ? html_entity_decode($sms->returned_msg) : 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 20px">
                                        <label class="col-sm-3"><b>Sent Phone Number(s): </b></label>
                                        <div class="col-sm-9">
                                            <p class="wrap-text text-justify">{{ !empty($sms->phones) ? $sms->phones : 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 20px">
                                        <label class="col-sm-3"><b>Invalid Phone Number(s): </b></label>
                                        <div class="col-sm-9">
                                            <p class="wrap-text text-justify">{{ !empty($sms->invalid_phones) ? html_entity_decode($sms->invalid_phones) : 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 20px">
                                        <label class="col-sm-3"><b>Duplicate Phone Number(s): </b></label>
                                        <div class="col-sm-9">
                                            <p class="wrap-text text-justify">{{ !empty($sms->duplicate_phones) ? $sms->duplicate_phones : 'N/A' }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="{{ url('sms') }}" class="btn btn-info btn-lg">
                                                <i class="fa fa-comment-alt"></i> Back
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
    <!-- /.content -->
    <script type="text/javascript">

        $(document).ready(function() {

        });
    </script>
@stop
