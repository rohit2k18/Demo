@extends('../layout')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title mb-0">View Product</h4>
            </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6 mb-3">
                            <label for="name" class="form-label">Product Name </label>
                            <input type="text" name="name" id="name" class="form-control " value="{{ $product->name }}" placeholder="Enter Name" >
                        </div>
                        <div class="form-group col-sm-6 mb-3">
                            <label for="price" class="form-label">Product Price</label>
                            <input type="text" name="price" id="price" class="form-control " value="{{ $product->price }}" placeholder="Enter price" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 mb-3">
                            <label for="stock" class="form-label">Stock Quantity</label>
                            <input type="number" name="stock" id="stock" class="form-control " value="{{$product->stock}}" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12 mb-3">
                            <label for="description" class="form-label">Description </label>
                            <textarea name="description" id="description" class="form-control  summernote" >{!!$product->description!!}</textarea>
                        </div>
                    </div>
                </div>
               
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#toptitle').text('New User');
        $('.products').css('backgroundColor', '#0059b3');
        $('.summernote').summernote({
            // placeholder: 'Job Description',
            tabsize: 2,
            height: 200,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                // ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
             ]
        });
    });
</script>
@endsection