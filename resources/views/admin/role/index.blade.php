@extends('layouts.app')

@section('content')

    <ol class="breadcrumb">
        <li><a class="breadcrumb-item" href="{{ url('home') }}">Home</a></li>
        <li><span class="breadcrumb-item active">Role Management</span></li>
    </ol>

<h1 class="text-center helpr-title">List Roles</h1>
<section>
    <div class="pull-right">
        <div class="btn-group">
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
        <th>Display Name</th>
        <th>Description</th>
        <th>Permissions</th>
        <th>Edit</th>
        </thead>
        <tbody>
        @foreach ($roles as $role)
            <tr>
                <td>
                    <div class="ckbox">
                        <input type="checkbox" class="ckbox-item" id="checkbox-{{ $role['id'] }}"
                               name="ids[]" value="{{ $role['id'] }}">
                        <label for="checkbox-{{ $role['id'] }}"></label>
                    </div>
                </td>
                <td>{{ $role['name'] }}</td>
                <td>{{ $role['display_name'] }}</td>
                <td>{{ $role['description'] }}</td>
                <td>
                    @foreach ($role->permissions as $permission)
                        {{ $permission['name'] }},
                    @endforeach
                </td>
                <td>
                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                        <a class="btn btn-primary btn-xs" data-title="Edit" href={{ url('role/edit',$role) }}>
                        <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                    </p>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

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
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
</section>
@endsection