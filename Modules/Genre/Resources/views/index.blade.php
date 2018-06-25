@extends('layouts.app')

@section('content')

<oil class="breadcrumb">
    <li><a class="breadcrumb-item" href="{{ url('home') }}">Home</a></li>
    <li><span class="breadcrumb-item active">Genre Management</span></li>
</oil>

<h1 class="text-center helpr-title">List Genre</h1>

<div class="container">
    {!! Form::open(array('url' => 'genre/index', 'method' => 'get')) !!}
    <div class="input-group col-md-4">
        {{--<input class="form-control py-2" type="search" name="search" placeholder="search" id="example-search-input">--}}
        {{--<span class="input-group-append">--}}
            {{--<button class="btn btn-outline-secondary" type="submit">--}}
                {{--<i class="glyphicon glyphicon-search"></i>--}}
            {{--</button>--}}
        {{--</span>--}}

        {{--<label class="control-label">Search</label>--}}
        <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control"
                       name="search" placeholder="Search" id="inputGroup"/>
                <span class="input-group-addon">
                        <i class="fa fa-search"></i>
                    </span>
            </div>
        </div>

    </div>
    {!! Form::close() !!}
</div>

<section>
    {!! Form::open(array('url' => 'genre/deleteMultiple', 'method' => 'post')) !!}
    <div class="pull-right">
        <div class="btn-group">
            @permission('genre-create')
            <a class="btn btn-success btn-filter" href="{{ url('genre', 'create') }}">Create</a>
            @endpermission
            @permission('genre-delete')
            <button type="submit" class="btn btn-danger btn-filter" data-target="pendiente">Delete</button>
            @endpermission
        </div>
    </div>
    <table id="mytable" class="table table-bordred table-striped">
        <thead>
            <th>
                <div class="ckbox">
                    <input type="checkbox" id="checkAll">
                    <label for="checkAll"></label>
                </div>
            </th>
            <th>Name</th>
            <th>Description</th>
            @permission('genre-edit')
            <th>Edit</th>
            @endpermission
            @permission('genre-delete')
            <th>Delete</th>
            @endpermission
        </thead>
        <tbody>
            @foreach ($genres as $genre)
            <tr>
                <td>
                    <div class="ckbox">
                        <input type="checkbox" class="ckbox-item" id="checkbox-{{ $genre['id'] }}" name="ids[]"
                               value="{{ $genre['id'] }}" >
                        <label for="checkbox-{{ $genre['id'] }}"></label>
                    </div>
                </td>
                <td><a href="{{ url('genre/show',$genre) }}">{{ $genre['name'] }}</a></td>
                {{--<td>{{ $genre['displayName'] }}</td>--}}
                <td>{{ $genre['description'] }}</td>
                @permission('genre-edit')
                <td>
                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                        <a class="btn btn-primary btn-xs" data-title="Edit" href={{ url('genre/edit',$genre) }}>
                        <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                    </p>
                </td>
                @endpermission
                @permission('genre-edit')
                <td><p data-placement="top" data-toggle="tooltip" title="Delete">
                        {{--<a class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#confirm-delete-123" href="{{ url('genre/delete',$genre['id']) }}"><span class="glyphicon glyphicon-trash"></span></a>--}}
                        <a class="btn btn-danger btn-xs" href="{{ url('genre/delete',$genre) }}"><span class="glyphicon glyphicon-trash"></span></a>
                    </p>
                </td>
                @endpermission
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ Form::close() }}

    <div class="pull-right">
        {{ $genres->appends($_GET)->links() }}
    </div>

    <div class="clearfix"></div>

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Delete this genre</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this genre?</div>

                </div>
                <div class="modal-footer ">
                    <a class="btn btn-success btn-ok" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script>
        // $('#confirm-delete').on('show.bs.modal', function(e) {
        //     $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        // });
    </script>
</section>
@endsection