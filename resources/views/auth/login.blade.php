<!DOCTYPE html>
<html class="no-js" lang="en-US" class="no-js">
<head>
    <title>Sign in to IMS Sentosa</title>
    <meta name="description" content="Sign in to IMS Sentosa" />
    <meta name="author" content="TECHATRIUM INNOVATION PET LTD" />

    <link rel="shortcut icon" href="{{ asset('images/ic_favicon.png') }}" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nanum+Gothic|Nanum+Gothic+Coding" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome-all.min.css') }}" />

    <!-- BEGIN LOGIN -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}?v=2" />
    <!-- END LOGIN -->
</head>
<body>
<div class="login">
    <div>
        <img id="login_screen_background" alt="Welcome to IMS Sentosa" title="Welcome to IMS Sentosa" src="{{ asset('images/placeholder.png') }}" />
    </div>
    <div>
        <div>
            <div>
                <a href="javascript:void(0)"><img src="{{ asset('images/logo.png') }}" alt="Sign in to IMS Sentosa" title="Sign in to IMS Sentosa"></a>
            </div>
            {{--<Form action="{{ url('login') }}" method="post" class="form-element" id="loginForm">--}}
            {!! Form::open(array('url' => 'login', 'class' => 'form-element', 'id' => 'loginForm')) !!}
                {{--{!!  csrf_field() !!}--}}
                <p>
                    <label>Email</label>
                    <input type="email" name="email" maxlength="96" class="{{ $errors->has('email') ? ' has-error' : '' }}" required />
                </p>
                @if ($errors->has('email'))
                    <div class="alert-error">
                        <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('email') }}
                    </div>
                @endif
                <p>
                    <label>Password</label>
                    <input type="password" name="password" maxlength="32" class="{{ $errors->has('password') ? ' has-error' : '' }}" required />
                </p>
                @if ($errors->has('password'))
                <div class="alert-error">
                    <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('password') }}
                </div>
                @endif
                <div>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} /> Remember me
                    <a href="{{ route('password.request') }}" class="forgot-password" style="float: right">Forgot Password?</a>
                </div>
                <input type="submit" id="loginBtn" class="form-control" value="Login" />
            {!! Form::close() !!}
            {{--</Form>--}}
        </div>
    </div>
    <div class="copyright">A product of <a href="javascript:void(0)">TECHATRIUM INNOVATION PTE LTD</a>. Copyright &copy; 2018. All rights reserved.</div>
</div>
<script src="{{ asset('assets/vendor_components/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/modernizr.min.js') }}"></script>
<script>
    $(document).keypress(function(event){

        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            $('#loginForm').submit();
        }
    });

    $(document).ready(function() {
        var width = $(window).width();
        if (width < 729) {
            $('#login_screen_background').closest('div').hide();
        } else {
            $('#login_screen_background').closest('div').show();
            $('#login_screen_background').attr('src', '{!! asset('images/bg.jpg') !!}?v=3')
        }
    });

    $(window).resize(function () {
        var width = $(window).width();

        if (width < 729) {
            $('#login_screen_background').closest('div').hide();
        } else {
            $('#login_screen_background').closest('div').show();
            $('#login_screen_background').attr('src', '{!! asset('images/bg.jpg') !!}?v=3')
        }
    } );
</script>
</body>
</html>