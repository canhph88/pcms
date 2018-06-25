@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a class="breadcrumb-item" href="{{ url('home') }}">Home</a></li>
    <li><a class="breadcrumb-item" href="{{ url('book', 'index') }}">Book Management</a></li>
    <li><span class="breadcrumb-item active">Show Book</span></li>
</ol>

<h1 class="text-center helpr-title">Show Book</h1>
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
                        <h3 class="panel-title">{{ $book->name }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4 col-lg-4" align="center">
                                <img src="{{URL::asset('/uploads/books/'.$book->image)}}" alt="{{ $book->name }}" class="img img-responsive" width="200" />
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
                            <div class=" col-md-8 col-lg-8 ">
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <td>Author:</td>
                                            <td>
                                                @foreach ($book->authors as $index=>$author)
                                                    @if($index < 3)
                                                        <p>
                                                            <a href="{{ url('author/show',$author) }}">{{ $author['name'] }}</a>
                                                        </p>
                                                    @elseif($index == 3)
                                                        {{ '...' }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Genre:</td>
                                            <td>
                                                @foreach ($book->genres as $index=>$genre)
                                                    @if($index < 3)
                                                        <p>
                                                            <a href="{{ url('genre/show',$genre) }}">{{ $genre['name'] }}</a>
                                                        </p>
                                                    @elseif($index == 3)
                                                        {{ '...' }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Price</td>
                                            <td>{{ $book->price }}</td>
                                        </tr>
                                        <tr>
                                            <td>Quantity</td>
                                            <td>{{ $book->quantity }}</td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>{{ $book->description }}</td>
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
                            <a href="{{ url('book/edit',$book) }}" data-original-title="Edit this book" data-toggle="tooltip" type="button" class="btn btn-primary">
                                <span class="glyphicon glyphicon-edit"></span> Edit
                            </a>
                            <a href="{{ url('book/delete',$book) }}" data-original-title="Remove this book" data-toggle="tooltip" type="button" class="btn btn-warning">
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