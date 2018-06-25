@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a class="breadcrumb-item" href="{{ url('home') }}">Home</a></li>
    <li><a class="breadcrumb-item" href="{{ url('book', 'index') }}">Book Management</a></li>
    <li><span class="breadcrumb-item active">Book download</span></li>
</ol>

<h1 class="text-center helpr-title">Excel Books Download</h1>
<section>
    <div class="container">
        <div class="row">
            <div class="col-xs-12" style="">
                <div class="panel panel-default list-group-panel">
                    <div class="panel-body">
                        <ul class="list-group list-group-header">
                            <li class="list-group-item list-group-body">
                                <div class="row">
                                    <div class="col-xs-6 text-left">Name</div>
                                    <div class="col-xs-3">Size</div>
                                    <div class="col-xs-3">Modified</div>
                                </div>
                            </li>
                        </ul>
                        <ul class="list-group list-group-body" style="">
                            @foreach($list as $file)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6 text-left" style=" ">
                                        <a href="{{ url('book/download', $file) }}"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> {{ $file }} </a> </div>
                                    <div class="col-xs-3" style="">...</div>
                                    <div class="col-xs-3" style=""> {{ date("F d Y H:i:s.", filemtime(storage_path("/app/").$file)) }} </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection