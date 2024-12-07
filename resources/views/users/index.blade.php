@extends('../layout')
@section('content')
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
    color: black !important;
}

</style>
<div class="row">
    <div class="col-sm-12">
        <div class="text-end">
            <a href="{{route('users.create')}}" class="btn btn-primary">New User</a>
        </div>
        <div class="card mt-3 p-3">
            <div class="table-responsive">
                <table class="table mt-2" id="jbTable">
                    <thead class="lightbody thead">
                        <tr>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th style="width:15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($users)>0)
                    @foreach($users as $user)
                    <tr id="user_{{$user->id}}">
                        <td>
                        {{$user->name}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td style="text-transform: capitalize">
                            {{$user->role}}
                        </td>
                        <td>
                        <a href="{{ route('users.edit', encrypt($user->id)) }}" class="edit"><i class="fa fa-pen"></i></a> 
                        <a href="javascript:void(0)" class="delete" onclick="deleteuser('{{$user->id}}');"><i class="fa fa-trash"></i></a> 
                        </td>
                    </tr>
                    @endforeach
                   
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#jbTable').DataTable();
        $('#jbTable_filter').addClass('mb-3');
        $('.users').css('backgroundColor','#0059b3');
    });

    function deleteuser(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/users/' + id,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function (response) {
                    // User deleted successfully
                    Swal.fire(
                    'Deleted!',
                    'User has been deleted.',
                    'success'
                    );
                    $('#user_'+id).remove();
                },
                error: function (xhr) {
                    // An error occurred during deletion
                    Swal.fire("Oops!", "Something went wrong while deleting the user.", "error");
                }
            });
        }
        });
    }
</script>
@endsection