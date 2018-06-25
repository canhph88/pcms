<!DOCTYPE html>
<html>
<head>
    <meta name="layout" content="main"/>
    <title>Login Page</title>

    {{--{!! HTML::style('asset/css/bootstrap.css') !!}--}}
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    {{--{!! HTML::style('css/app.css') !!}--}}

    {{--{!! HTML::script('js/jquery-min.js') !!}--}}
    {{--{!! HTML::script('js/bootstrap.js') !!}--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<h1 class="text-center helpr-title">Login Page</h1>
<section>
    <div class="col-sm-12 col-md-6 col-md-offset-3">
        {!! Form::open(array('url' => 'login')) !!}

        <!-- if there are login errors, show them here -->
        <p>
            {{ $errors->first('username') }}
            {{ $errors->first('password') }}
        </p>

        <p>
            {{ Form::label('username', 'Username') }}
            {{ Form::text('username', Input::old('username'), array('placeholder' => 'awesome')) }}
        </p>

        <p>
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password') }}
        </p>

        <p>{{ Form::submit('Submit!') }}</p>

        {!! Form::close() !!}
    </div>
</section>
</body>
</html>