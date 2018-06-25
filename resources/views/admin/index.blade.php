@extends('layouts.app')

@section('content')

<nav class="breadcrumb">

    {{--<a class="breadcrumb-item" href="{{ url('admin', 'index') }}"></a>--}}

    <span class="breadcrumb-item active">Manager Home</span>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    Available controllers:
                </div>
                <div class="row justify-content-center">
                    <div class="">
                        <div class="btn-group btn-group-justified">
                            @permission('book-*')
                            <a type="button" class="btn btn-primary" href="{{ url('book', 'index') }}">Book</a>
                            @endpermission
                            @permission('author-*')
                            <a type="button" class="btn btn-primary" href="{{ url('author') }}">Author</a>
                            @endpermission
                            @permission('genre-*')
                            <a type="button" class="btn btn-primary" href="{{ url('genre') }}">Genre</a>
                            @endpermission
                            @permission('user-*')
                            <a type="button" class="btn btn-primary" href="{{ url('user') }}">User</a>
                            @endpermission
                            @permission('role-*')
                            <a type="button" class="btn btn-primary" href="{{ url('role') }}">Role</a>
                            @endpermission
                        </div>
                    </div>
                </div>
                <br />
            </div>
        </div>
    </div>

    {{--<div class="row">--}}
        {{--<!-- Start of Button Group -->--}}
        {{--<div class="btn-group" role="group" aria-label="Horizontal Button Group">--}}
            {{--<button type="button" class="btn btn-primary">Button 1 </button>--}}
            {{--<button type="button" class="btn btn-warning">Button 2</button>--}}
            {{--<button type="button" class="btn btn-danger">Button 3</button>--}}
            {{--<button type="button" class="btn btn-info">Button 4</button>--}}
        {{--</div>--}}
    {{--</div>--}}
</div>
@endsection
