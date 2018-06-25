@extends('layouts.app')

@section('content')

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
        <a class="breadcrumb-item" href="{{ url('role', 'index') }}">Role Management</a>
        <span class="breadcrumb-item active">Create Role</span>
    </nav>

<h1 class="text-center helpr-title">Create Role</h1>
<section>
    <div class="col-sm-12 col-md-6 col-md-offset-3">
        {!! Form::model($user, ['action' => 'RoleController@store', 'method' => 'post', 'files' => 'true']) !!}

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
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
            <span class="text-danger">{{ $errors->first('email') }}</span>
        </div>

        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', null, ['class' => 'form-control']) !!}
            <span class="text-danger">{{ $errors->first('password') }}</span>
        </div>

        <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
            {!! Form::label('permissions', 'permissions') !!}
            @foreach ($permissions as $permission)
            <div class="multi-check">
                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input" id="permission-{{ $permission->id }}">
                <label class="form-check-label" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
            </div>
            @endforeach
        </div>

        <div class="form-group">
            {!! Form::label('address', 'Address') !!}
            {!! Form::textarea('address', null, ['rows' => '4', 'cols' => '40', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group text-center">
            {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
            {!! Form::reset('Reset', ['class' => 'btn btn-info']) !!}
        </div>

        {!! Form::close() !!}
    </div>
</section>
@endsection