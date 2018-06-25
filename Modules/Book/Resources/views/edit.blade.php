@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a class="breadcrumb-item" href="{{ url('home') }}">Home</a></li>
    <li><a class="breadcrumb-item" href="{{ url('book', 'index') }}">Book Management</a></li>
    <li><span class="breadcrumb-item active">Update Book</span></li>
</ol>

<h1 class="text-center helpr-title">Edit Book</h1>
<section>
    <div class="col-sm-12 col-md-6 col-md-offset-3">
        {!! Form::model($book, ['url' => '/book/update', 'method' => 'post', 'files' => 'true', 'id' => 'edit-book-form']) !!}

        {{--{!! Form::hidden('id', null, ['class' => 'form-control']) !!}--}}
        <input name="id" type="hidden" value="{{ $book->id }}">

        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>

        <div class="form-group">
            {!! Form::label('authors', 'Authors') !!}
            <select id="multi-author" name="authors[]" multiple="multiple">
                {{--<option selected>Open this select menu</option>--}}
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}"
                            {{ in_array($author->id, $book->authors->pluck('id')->toArray()) ? 'selected="selected" checked' : '' }}
                    >{{ $author->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {!! Form::label('genres', 'Genres') !!}
            <select id="multi-genre" name="genres[]" multiple="multiple">
                {{--<option selected>Open this select menu</option>--}}
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}"
                            {{ in_array($genre->id, $book->genres->pluck('id')->toArray()) ? 'selected="selected" checked' : '' }}
                    >{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
            {!! Form::label('quantity', 'Quantity') !!}
            {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
            <span class="text-danger">{{ $errors->first('quantity') }}</span>
        </div>

        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
            {!! Form::label('price', 'Price') !!}
            {!! Form::text('price', null, ['class' => 'form-control']) !!}
            <span class="text-danger">{{ $errors->first('price') }}</span>
        </div>

        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
            {!! Form::label('image-test', 'Image') !!}
            {!! Form::file('image-test', null, ['class'=>'btn-white form-control', 'placeholder'=>'Enter image Url']) !!}
            <span class="text-danger">{{ $errors->first('image-test') }}</span>
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null, ['rows' => '4', 'cols' => '40', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group text-center">
            {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
            {!! Form::reset('Reset', ['class' => 'btn btn-info']) !!}
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

            $('#edit-book-form').on('reset', function () {
                var authorArray = {{ json_encode($book->authors->pluck('id')->toArray()) }};
                var genreArray = {{ json_encode($book->genres->pluck('id')->toArray()) }};

                $('#multi-author option:selected').each(function() {
                    $(this).prop('selected', false);

                });
                $.each(authorArray, function (index, item) {
                    $('#multi-author option[value='+ item + ']').each(function() {
                        $(this).prop('selected', true);
                    });
                });
                // alert($('#multi-author').next().find('input[value=3]').length);


                //
                //
                // var showChecks = $('#multi-author').next().find('input[value=3]');
                // $.each(showChecks, function (index, item) {
                //     $(item).trigger('click');
                //     // console.log($(item).prop('checked'));
                // });

                $('#multi-genre option:selected').each(function() {
                    $(this).prop('selected', false);
                });
                $.each(genreArray, function (index, item) {
                    $('#multi-genre option[value='+ item + ']').each(function() {
                        $(this).prop('selected', true);
                    });
                });

                $('#multi-author').multiselect('refresh');
                $('#multi-genre').multiselect('refresh');
                $('#multi-genre').multiselect('rebuild');
                // $('#multi-author').multiselect('select', authorArray);
            });
        });
    </script>

</section>
@endsection