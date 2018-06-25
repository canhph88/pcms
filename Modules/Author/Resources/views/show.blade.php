@extends('layouts.app')

@section('content')

    <ol class="breadcrumb">
        <li><a class="breadcrumb-item" href="{{ url('home') }}">Home</a></li>
        <li><a class="breadcrumb-item" href="{{ url('author', 'index') }}">Author Management</a></li>
        <li><span class="breadcrumb-item active">Show Author</span></li>
    </ol>

<h1 class="text-center helpr-title">Show Author</h1>
<section>
    <div class="container">
        <div class="row">
            {{--<div class="col-md-5  toppad  pull-right col-md-offset-3 ">--}}
                {{--<A href="edit.html" >Edit Profile</A>--}}

                {{--<A href="edit.html" >Logout</A>--}}
                {{--<br>--}}
                {{--<p class=" text-info">May 05,2014,03:00 pm </p>--}}
            {{--</div>--}}
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $author->name }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 " align="center">
                                {{--<img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive">--}}
                            </div>

                            <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                              <dl>
                                <dt>DEPARTMENT:</dt>
                                <dd>Administrator</dd>
                                <dt>HIRE DATE</dt>
                                <dd>11/12/2013</dd>
                                <dt>DATE OF BIRTH</dt>
                                   <dd>11/12/2013</dd>
                                <dt>GENDER</dt>
                                <dd>Male</dd>
                              </dl>
                            </div>-->
                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <td>Full name:</td>
                                            <td>
                                                    {{ $author['fullName'] }}
                                            </tr>
                                        <tr>
                                            <td>Books:</td>
                                            <td>
                                                @foreach ($author->books as $index=>$book)
                                                    @if($index < 3)
                                                        <p>
                                                            <a href="{{ url('book/show',$book) }}">{{ $book['name'] }}</a>
                                                        </p>
                                                    @else
                                                        {{ '...' }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Birthday</td>
                                            <td>{{ $author->birthday }}</td>
                                        </tr>
                                        <tr>
                                            <td>Hometown</td>
                                            <td>{{ $author->hometown }}</td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td>{{ $author->country }}</td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>{{ $author->description }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                {{--<a href="#" class="btn btn-primary">My Sales Performance</a>--}}
                                {{--<a href="#" class="btn btn-primary">Team Sales Performance</a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        {{--<a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>--}}
                        <span class="pull-right">
                            <a href="{{ url('author/edit',$author) }}" data-original-title="Edit this author" data-toggle="tooltip" type="button" class="btn btn-primary">
                                <span class="glyphicon glyphicon-edit"></span> Edit
                            </a>
                            <a href="{{ url('author/delete',$author) }}" data-original-title="Remove this author" data-toggle="tooltip" type="button" class="btn btn-warning">
                                <span class="glyphicon glyphicon-remove"></span> Delete
                            </a>
                        </span>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection