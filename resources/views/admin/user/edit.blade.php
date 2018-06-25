@extends('layouts.app')

@section('content')

    <ol class="breadcrumb">
        <li><a class="breadcrumb-item" href="{{ url('home') }}">Home</a></li>
        <li><a class="breadcrumb-item" href="{{ url('user', 'index') }}">User Management</a></li>
        <li><span class="breadcrumb-item active">Update User</span></li>
    </ol>

    <h1 class="text-center helpr-title">Edit User</h1>
    <section>
        <div class="col-sm-12 col-md-6 col-md-offset-3">
            {!! Form::model($user, ['action' => 'UserController@update', 'method' => 'post', 'files' => 'true']) !!}

            {{--{!! Form::hidden('id', {{ book->id }}, ['class' => 'form-control']) !!}--}}
            <input name="id" type="hidden" value="{{ $user->id }}">

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                {!! Form::label('username', 'Username') !!}
                {!! Form::text('username', null, ['class' => 'form-control']) !!}
                <span class="text-danger">{{ $errors->first('username') }}</span>
            </div>

            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                {!! Form::label('email', 'Email') !!}
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
                <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>

            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                {!! Form::label('roles', 'Role') !!}
                <div class="container">
                    @foreach ($roles as $role)
                        <div class="multi-check">
                            <input type="radio" name="roles[]" value="{{ $role->id }}" class="form-check-input" id="role-{{ $role->id }}"
                                    {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('address', 'Address') !!}
                {!! Form::textarea('address', null, ['rows' => '4', 'cols' => '40', 'class' => 'form-control']) !!}
            </div>

            <div class="form-group text-center">
                {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                {!! Form::reset('Reset', ['class' => 'btn btn-info']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </section>
@endsection