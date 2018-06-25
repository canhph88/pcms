@extends('layouts.app')

@section('content')

    <ol class="breadcrumb">
        <li><a class="breadcrumb-item" href="{{ url('home') }}">Home</a></li>
        <li><a class="breadcrumb-item" href="{{ url('author', 'index') }}">Author Management</a></li>
        <li><span class="breadcrumb-item active">Update Author</span></li>
    </ol>

<h1 class="text-center helpr-title">Edit Author</h1>

<section>
    <div class="col-sm-12 col-md-6 col-md-offset-3">
        {!! Form::model($author, ['url' => 'author/update', 'method' => 'post', 'files' => 'true']) !!}

        {{--{!! Form::hidden('id', null, ['class' => 'form-control']) !!}--}}
        <input name="id" type="hidden" value="{{ $author->id }}">

        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>

        <div class="form-group {{ $errors->has('fullName') ? 'has-error' : '' }}">
            {!! Form::label('fullName', 'Full Name') !!}
            {!! Form::text('fullName', null, ['class' => 'form-control']) !!}
            <span class="text-danger">{{ $errors->first('fullName') }}</span>
        </div>

        <div class="form-group {{ $errors->has('birthday') ? 'has-error' : '' }}">
            {!! Form::label('birthday', 'Birthday') !!}
            {!! Form::date('birthday', null, ['class' => 'form-control']) !!}
            <span class="text-danger">{{ $errors->first('birthday') }}</span>
        </div>

        <div class="form-group {{ $errors->has('hometown') ? 'has-error' : '' }}">
            {!! Form::label('hometown', 'Hometown') !!}
            {!! Form::text('hometown', null, ['class' => 'form-control']) !!}
            <span class="text-danger">{{ $errors->first('hometown') }}</span>
        </div>

        <div class="form-group">
            {!! Form::label('country', 'Country') !!}
            <select id="select-country" name="country">
                <option value="" selected>Select country</option>
                @foreach ($countries as $country)
                    <option value="{{ $country }}"
                        {{ $country == $author->country ? 'selected="selected"' : '' }}>{{ $country }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group text-center">
            {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
            {!! Form::reset('Reset', ['class' => 'btn btn-info']) !!}
        </div>

        {!! Form::close() !!}
    </div>

    <script>
        $(document).ready(function() {

            $('#select-country').multiselect({
                enableFiltering: true,
                // filterBehavior: 'data'
            });
        });
    </script>

</section>
@endsection