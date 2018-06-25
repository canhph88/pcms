@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a class="breadcrumb-item" href="{{ url('home') }}">Home</a></li>
    <li><span class="breadcrumb-item active">User Management</span></li>
</ol>

<h1 class="text-center helpr-title">List Users</h1>
<section>
    {!! Form::open(array('url' => 'user/deleteMultiple', 'method' => 'post')) !!}
    <div class="pull-right">
        <div class="btn-group">
            @permission('user-create')
            <a class="btn btn-primary btn-filter" href="{{ url('user', 'export') }}">Export</a>
            @endpermission
            @permission('user-create')
            <a class="btn btn-success btn-filter" href="{{ url('user', 'create') }}">Create</a>
            @endpermission
            @permission('user-delete')
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
            <th>Username</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>
                    <div class="ckbox">
                        <input type="checkbox" class="ckbox-item" name="ids" id="checkbox-{{ $user['id'] }}"
                               value="{{ $user['id'] }}">
                        <label for="checkbox-{{ $user['id'] }}"></label>
                    </div>
                </td>
                <td><a href="{{ url('user/show',$user) }}">{{ $user['name'] }}</a></td>
                <td>{{ $user['username'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>
                    @foreach ($user->roles as $role)
                        {{ $role['name'] }}
                    @endforeach
                </td>
                <td>
                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                        <a class="btn btn-primary btn-xs" data-title="Edit" href={{ url('user/edit',$user) }}>
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                    </p>
                </td>
                <td><p data-placement="top" data-toggle="tooltip" title="Delete">
                        {{--<a class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#confirm-delete" href="{{ url('user/destroy',$user['id']) }}"><span class="glyphicon glyphicon-trash"></span></a>--}}
                        <a class="btn btn-danger btn-xs" href="{{ url('user/delete',$user) }}"><span class="glyphicon glyphicon-trash"></span></a>
                    </p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ Form::close() }}

    <div class="pull-right">
        {{ $users->links() }}
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

                    <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this user?</div>

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