@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a class="breadcrumb-item" href="{{ url('home') }}">Home</a></li>
    <li><span class="breadcrumb-item active">Book Management</span></li>
</ol>

<h1 class="text-center helpr-title">List Book</h1>

<div class="container">
    {!! Form::open(array('url' => 'book/index', 'method' => 'get')) !!}
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
    {!! Form::open(array('url' => 'book/deleteMultiple', 'method' => 'post')) !!}
    <div class="pull-right">
        <div class="btn-group">
            @permission('book-create')
            {{--<a class="btn btn-warning btn-filter" href="{{ url('book', 'import') }}">Import</a>--}}
            <a class="btn btn-warning btn-filter" data-title="import" data-toggle="modal"
               data-target="#import-dialog" data-href="{{ url('book', 'importExcel') }}">
                Import
            </a>
            @endpermission
            @permission('book-create')
            <a class="btn btn-primary btn-filter" href="{{ url('book', 'export') }}">Export</a>
            @endpermission
            @permission('book-create')
            <a class="btn btn-success btn-filter" href="{{ url('book', 'create') }}">Create</a>
            @endpermission
            @permission('book-delete')
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
        <th>Image</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Price</th>
        <th>Quantity</th>
        @permission('book-edit')
        <th>Edit</th>
        @endpermission
        @permission('book-delete')
        <th>Delete</th>
        @endpermission
        </thead>
        <tbody>

        @foreach ($books as $book)
            <tr>
                <td>
                    <div class="ckbox input-group">
                        <input type="checkbox" class="ckbox-item" id="checkbox-{{ $book['id'] }}"
                               name="ids[]" value="{{ $book['id'] }}">
                        <label for="checkbox-{{ $book['id'] }}"></label>
                    </div>
                </td>
                <td>
                    <a href="{{ url('book/show',$book) }}">{{ $book['name'] }}</a>
                </td>
                <td><img src="{{URL::asset('/uploads/books/'.$book->image)}}" alt="{{ $book->name }}" class="img img-responsive" width="100" /></td>
                <td>
                    @foreach ($book->authors as $index=>$author)
                        @if($index < 3 && $index < ($book->authors->count()-1))
                            {{ $author['name'] }},
                        @elseif($index < 4 && $index < ($book->authors->count()))
                            {{ $author['name'] }}
                        @endif

                        @if($index == 4)
                            {{ '...' }}
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($book->genres as $index=>$genre)
                        @if($index < 3)
                            {{ $genre['name'] }}<br />
                        @endif

                        @if($index == 3)
                            {{ '...' }}
                        @endif
                    @endforeach
                </td>
                <td>{{ $book['price'] }}</td>
                <td>{{ $book['quantity'] }}</td>
                @permission('book-edit')
                <td>
                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                        <a class="btn btn-primary btn-xs" data-title="Edit" href="{{ url('book/edit',$book) }}">
                        {{--<span class="glyphicon glyphicon-pencil"></span>--}}
                            {{--<span class="oi oi-cog"></span>--}}
                            <span class="fa fa-edit"></span>
                        </a>
                    </p>

                </td>
                @endpermission
                @permission('book-delete')
                <td><p data-placement="top" data-toggle="tooltip" title="Delete">
                        {{--<a class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#confirm-delete-123" href="{{ url('book/destroy',$book['id']) }}"><span class="glyphicon glyphicon-trash"></span></a>--}}
                        <a class="btn btn-danger btn-xs" href="{{ url('book/delete',$book) }}">
                            <span class="fa fa-trash"></span>
                        </a>
                    </p>
                </td>
                @endpermission

            </tr>
        @endforeach

        </tbody>

    </table>
    {{ Form::close() }}

    <div class="pull-right">

            {{ $books->appends($_GET)->links() }}

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

    <div class="modal fade" id="import-dialog" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            {!! Form::open(array('url' => 'book/import', 'method' => 'post', 'files' => 'true')) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Import file</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group {{ $errors->has('import_file') ? 'has-error' : '' }}">
                        {!! Form::label('import_file', 'Import File') !!}
                        {!! Form::file('import_file', null, ['class'=>'btn-white form-control', 'placeholder'=>'Enter Import File Url']) !!}
                        <span class="text-danger">{{ $errors->first('import_file') }}</span>
                    </div>

                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-success btn-ok" ><span class="glyphicon glyphicon-ok-sign"></span> Import</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                </div>
            </div>
            {!! Form::close() !!}
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script>
        // $('#confirm-delete').on('show.bs.modal', function(e) {
            // $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        // });
    </script>
</section>
@endsection