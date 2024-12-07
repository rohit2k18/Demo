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
        @can('isAdmin')
            <a href="{{ route('products.create') }}" class="btn btn-primary">New Product</a>
        @endcan
        </div>
        <div class="card mt-3 p-3">
            <div class="table-responsive">
                <table class="table mt-2" id="jbTable">
                    <thead class="lightbody thead">
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th style="width:15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($products)>0)
                    @foreach($products as $prod)
                    <tr id="prod_{{$prod->id}}">
                        <td>
                        {{$prod->name}}
                        </td>
                        <td>
                            {{$prod->price}}
                        </td>
                        <td>
                            {{$prod->stock}}
                        </td>
                        <td>
                        @can('isAdmin')
                        <a href="{{ route('products.edit', encrypt($prod->id)) }}" class="edit"><i class="fa fa-pen"></i></a> 
                        <a href="javascript:void(0)" class="delete" onclick="deleteproduct('{{$prod->id}}')"><i class="fa fa-trash"></i></a> 
                        @endcan
                        <a href="{{ route('products.show',encrypt($prod->id))}}" class="ms-2 edit"><i class="fa fa-eye"></i></a>
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
        $('.products').css('backgroundColor','#0059b3');
    });

    function deleteproduct(id){
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
                url: '/products/' + id,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function (response) {
                    // User deleted successfully
                    Swal.fire(
                    'Deleted!',
                    'product has been deleted.',
                    'success'
                    );
                    $('#prod_'+id).remove();
                },
                error: function (xhr) {
                    // An error occurred during deletion
                    Swal.fire("Oops!", "Something went wrong while deleting the product.", "error");
                }
            });
        }
        });
    }
</script>
@endsection