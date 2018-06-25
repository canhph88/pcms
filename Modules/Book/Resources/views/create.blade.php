@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a class="breadcrumb-item" href="{{ url('home') }}">Home</a></li>
    <li><a class="breadcrumb-item" href="{{ url('book', 'index') }}">Book Management</a></li>
    <li><span class="breadcrumb-item active">Create Book</span></li>
</ol>

    {{--<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>--}}


    <h1 class="text-center helpr-title">Add Book</h1>
<section>
    <div class="col-sm-12 col-md-6 col-md-offset-3">
        {!! Form::model($book, ['url' => '/book/store', 'method' => 'post', 'files' => 'true', 'id' => 'create-book-form']) !!}

        {{--{!! Form::hidden('id', {{ book->id }}, ['class' => 'form-control']) !!}--}}
        <input name="id" type="hidden" value="{{ $book->id }}">

        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
            <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>

        {{--<div class="form-group {{ $errors->has('authors') ? 'has-error' : '' }}">--}}
            {{--{!! Form::label('authors', 'Authors') !!}--}}
            {{--<div class="container">--}}
                {{--@foreach ($authors as $author)--}}
                    {{--<div class="multi-check">--}}
                        {{--<input type="checkbox" name="authors[]" value="{{ $author->id }}" class="form-check-input" id="author-{{ $author->id }}">--}}
                        {{--<label class="form-check-label" for="author-{{ $author->id }}">{{ $author->name }}</label>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="form-group">
            {!! Form::label('authors', 'Authors') !!}
            <select id="multi-author" name="authors[]" multiple="multiple">
                {{--<option selected>Open this select menu</option>--}}
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" data="{{ $author->name }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Build your select: -->

        <div class="form-group">
            {!! Form::label('genres', 'Genres') !!}
            <select id="multi-genre" name="genres[]" multiple="multiple">
                {{--<option selected>Open this select menu</option>--}}
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
            {!! Form::label('quantity', 'Quantity') !!}
            {!! Form::text('quantity', old('quantity'), ['class' => 'form-control']) !!}
            <span class="text-danger">{{ $errors->first('quantity') }}</span>
        </div>

        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
            {!! Form::label('price', 'Price') !!}
            {!! Form::text('price', old('price'), ['class' => 'form-control']) !!}
            <span class="text-danger">{{ $errors->first('price') }}</span>
        </div>

        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
            {!! Form::label('image-test', 'Image') !!}
            {!! Form::file('image-test', null, ['class'=>'btn-white form-control', 'placeholder'=>'Enter image Url']) !!}
            <span class="text-danger">{{ $errors->first('image-test') }}</span>
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', old('description'), ['rows' => '4', 'cols' => '40', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group text-center">
            {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
            {!! Form::reset('Reset', ['id' => 'multi-reset-btn', 'class' => 'btn btn-info']) !!}
        </div>

        {!! Form::close() !!}
    </div>

    <script>
        $(document).ready(function() {

            $('#multi-author').multiselect({
                enableCaseInsensitiveFiltering: true,
                // filterBehavior: 'data'
            });

            $('#multi-genre').multiselect({
                enableCaseInsensitiveFiltering: true,
                // filterBehavior: 'value'
            });

            $('#create-book-form').on('reset', function () {
                $('#multi-author option:selected').each(function() {
                    $(this).prop('selected', true);
                });
                $('#multi-genre option:selected').each(function() {
                    $(this).prop('selected', false);
                });

                $('#multi-author').multiselect('refresh');
                $('#multi-genre').multiselect('refresh');
            });
        });
    </script>

</section>
@endsection