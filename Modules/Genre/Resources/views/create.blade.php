@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a class="breadcrumb-item" href="{{ url('home') }}">Home</a></li>
    <li><a class="breadcrumb-item" href="{{ url('genre', 'index') }}">Genre Management</a></li>
    <li><span class="breadcrumb-item active">Create Genre</span></li>
</ol>

<h1 class="text-center helpr-title">Create Genre</h1>

<section>
    <div class="col-sm-12 col-md-6 col-md-offset-3">
        {!! Form::open(array('url' => 'genre/store', 'method' => 'post')) !!}

        {{--{!! Form::hidden('id', {{ book->id }}, ['class' => 'form-control']) !!}--}}
        <input name="id" type="hidden" value="{{ $genre->id }}">

        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null, ['rows' => '4', 'cols' => '40', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group text-center">
            {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
            {!! Form::reset('Reset', ['class' => 'btn btn-info']) !!}
        </div>

        {!! Form::close() !!}
    </div>
</section>
@endsection