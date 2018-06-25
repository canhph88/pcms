@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a class="breadcrumb-item" href="{{ url('home') }}">Home</a></li>
    <li><span class="breadcrumb-item active">Author Management</span></li>
</ol>

<h1 class="text-center helpr-title">List Author</h1>

<div class="container">
    {!! Form::open(array('url' => 'author/index', 'method' => 'get')) !!}
    <div class="input-group col-md-4">
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
    {!! Form::open(array('url' => 'author/deleteMultiple', 'method' => 'post')) !!}
    <div class="pull-right">
        <div class="btn-group">
            @permission('author-create')
            <a class="btn btn-success btn-filter" href="{{ url('author', 'create') }}">Create</a>
            @endpermission
            @permission('author-delete')
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
            <th>Full name</th>
            <th>Birthday</th>
            <th>Hometown</th>
            <th>Country</th>
            @permission('author-edit')
            <th>Edit</th>
            @endpermission
            @permission('author-delete')
            <th>Delete</th>
            @endpermission
        </thead>
        <tbody>
        @php $hashids = new \Hashids\Hashids('secret') @endphp
        @foreach ($authors as $author)
            @php $id = $hashids->encode($author->id) @endphp
            <tr>
                <td>
                    <div class="ckbox">
                        <input type="checkbox" id="checkbox-{{ $id }}" class="ckbox-item" name="ids[]"
                               value="{{ $id }}" >
                        <label for="checkbox-{{ $id }}"></label>
                    </div>
                </td>
                <td><a href="{{ url('author/show',$author) }}">{{ $author['name'] }}</a></td>
                <td>{{ $author['fullName'] }}</td>
                <td>{{ $author['birthday'] }}</td>
                <td>{{ $author['hometown'] }}</td>
                <td>{{ $author['country'] }}</td>
                @permission('author-edit')
                <td>
                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                        <a class="btn btn-primary btn-xs" data-title="Edit" href={{ url('author/edit',$author) }}>
                        <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                    </p>
                </td>
                @endpermission
                @permission('author-delete')
                <td><p data-placement="top" data-toggle="tooltip" title="Delete">
                        {{--<a class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#confirm-delete" href="{{ url('author/destroy',$author['id']) }}"><span class="glyphicon glyphicon-trash"></span></a>--}}
                        <a class="btn btn-danger btn-xs" href="{{ url('author/delete',$author) }}"><span class="glyphicon glyphicon-trash"></span></a>
                    </p>
                </td>
                @endpermission
            </tr>
        @endforeach
        </tbody>
    </table>
    {!!  Form::close() !!}

    <div class="pull-right">
        {{ $authors->appends($_GET)->links() }}
    </div>

    <div class="clearfix"></div>

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this book?</div>

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