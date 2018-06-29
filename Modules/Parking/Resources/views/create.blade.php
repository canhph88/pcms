@extends('layouts.main')

@section('header_title')
    Create Parking
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
            Create Parking
{{--            <small>{{ $br->incident_id }}</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{!! url('parking') !!}"><i class="fa fa-comment-alt"></i> Parking Listing</a></li>
            <li class="breadcrumb-item"> Create Parking</li>
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
                    <form method="post" action="{{ url('parking/store') }}" id="smsSendForm" name="smsSendForm" enctype='multipart/form-data'>
                        {!! Form::token() !!}
                        <div class="box-header">
                            <h3 class="box-title">Input Parking</h3>
                        </div>
                        <div class="box-body">

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="parkingName">Parking name<span class="text-danger">*</span>:</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="parkingName" id="parkingName" placeholder='Parking name' type="text" value="{{ old('parkingName') }}" minlength="3" maxlength="160" />
                                    <p class="help-block text-warning">
                                        {{ $errors->first('parkingName') }}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="phone">Phone numbers<span class="text-danger">*</span>:</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="phone" id="phone" placeholder='Phone' type="text" value="{{ old('phone') }}" minlength="4" maxlength="30" />
                                    <p class="help-block text-warning">
                                        {{ $errors->first('phone') }}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="minPrice">Min price<span class="text-danger">*</span>:</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="minPrice" id="minPrice" placeholder='Min price' value="{{ old('minPrice') }}" />
                                    <p class="help-block text-warning">
                                        {{ $errors->first('minPrice') }}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="minPrice">Max price<span class="text-danger">*</span>:</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="maxPrice" id="maxPrice" placeholder='Max price' value="{{ old('maxPrice') }}" />
                                    <p class="help-block text-warning">
                                        {{ $errors->first('maxPrice') }}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="minPrice">Open time<span class="text-danger">*</span>:</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="openTime" id="openTime"  value="{{ old('openTime') }}" min="0" max="23" />
                                    <p class="help-block text-warning">
                                        {{ $errors->first('openTime') }}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="minPrice">Close time<span class="text-danger">*</span>:</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="closeTime" id="closeTime"  value="{{ old('closeTime') }}" min="0" max="23" />
                                    <p class="help-block text-warning">
                                        {{ $errors->first('closeTime') }}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="adrDistrictId" class="col-sm-2 col-form-label required">District :</label>
                                <div class="col-sm-8">
                                    <select class="custom-select form-control select2 required" id="adrDistrictId" name="adrDistrictId">
                                        <option value="">Select district</option>
                                        @foreach($districts as $d)
                                            <option value="{{ $d->id }}" {{ old('adrDistrictId') == $d->id ? "selected": "" }}>{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger"></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="adrWardId" class="col-sm-2 col-form-label required">Ward :</label>
                                <div class="col-sm-8">
                                    <select class="custom-select form-control select2 required" id="adrWardId" name="adrWardId">
                                        <option value="">Select ward</option>
                                    </select>
                                    <div class="text-danger"></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="adrStreet">Street<span class="text-danger">*</span>:</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="adrStreet" id="adrStreet" placeholder='Street' type="text" value="{{ old('adrStreet') }}" minlength="4" maxlength="255" />
                                    <p class="help-block text-warning">
                                        {{ $errors->first('adrStreet') }}
                                    </p>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="addressFull">Content<span class="text-danger">*</span>:</label>
                                <div class="col-sm-10 col-md-8">
                                    <textarea class="form-control" name="addressFull" id="addressFull" rows="3" placeholder="Address" >{{ old('addressFull') }}</textarea>
                                    <p class="help-block text-warning">{{ $errors->first('addressFull') }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="locationIncidentSelectBox" class="col-sm-4 col-form-label required">Location :</label>
                                <div class="col-sm-8">
                                    <div class="text-danger"></div>
                                    <div id="overlayermap" class="gmaps"></div>
                                    <input type="hidden" id="longtitude" name="longtitude" value="1.355815" />
                                    <input type="hidden" id="latitude" name="latitude" value="103.860554" />
                                </div>
                            </div>

                        </div>
                        <hr style="display: block;height: 2px;border: 0;border-top: 2px solid #0b93d5;">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-2 float-right">
                                    <button id="submit-btn" type="submit" class="btn bg-olive btn-block">
                                        <i class="fa fa-save"></i> Create
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
        var position = [10.7970556, 106.657286];
        var map;
        var marker;

        var common = new IMSCommon();

        function initialize()
        {
            map = new google.maps.Map(document.getElementById('overlayermap'), {
                center: new google.maps.LatLng(position[0], position[1]),//Setting Initial Position
                zoom: 14,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            marker = new google.maps.Marker({
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: new google.maps.LatLng(map.getCenter().lat(), map.getCenter().lng()),
                map: map,
                title: name
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);

        $('#adrDistrictId').change(function() {
            var selected = $(this).find('option:selected');
            parent_id = selected.val();
            $.get('/ajaxWardList/'+parent_id, function(data, response) {
                if (response === "success" && data) {
                    common.emptySelectBox('adrWardId', 'Select ward','', true);
                    var childs = common.fetchData(data);
                    if (childs !== "") {
                        $('#adrWardId').append(childs);
                    }
                }
            });
        });

        $(document).ready(function () {


        });
    </script>

@endsection
