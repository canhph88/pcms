@extends('layouts.app')

@section('content')

    <ol class="breadcrumb">
        <li><a class="breadcrumb-item" href="{{ url('home') }}">Home</a></li>
        <li><a class="breadcrumb-item" href="{{ url('role', 'index') }}">Role Management</a></li>
        <li><span class="breadcrumb-item active">Edit Role</span></li>
    </ol>

    <h1 class="text-center helpr-title">Edit Role</h1>
    <section>
        <div class="col-sm-12 col-md-6 col-md-offset-3">
            {!! Form::model($role, ['action' => 'RoleController@update', 'method' => 'post']) !!}

            {{--{!! Form::hidden('id', {{ book->id }}, ['class' => 'form-control']) !!}--}}
            <input name="id" type="hidden" value="{{ $role->id }}">

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
                {!! Form::label('display_name', 'Display name') !!}
                {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
                <span class="text-danger">{{ $errors->first('display_name') }}</span>
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', null, ['rows' => '4', 'cols' => '40', 'class' => 'form-control']) !!}
            </div>

            <div class="form-group clearfix {{ $errors->has('permissions') ? 'has-error' : '' }}">
                <p>{!! Form::label('permissions', 'Permissions') !!}</p>
                @foreach ($permissions as $permission)
                    <div class="multi-check col-md-4">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input multi-check" id="permission-{{ $permission->id }}"
                        {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="role-{{ $permission->id }}">{{ $permission->name }}</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group text-center">
                {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                {!! Form::reset('Reset', ['class' => 'btn btn-info']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </section>
@endsection