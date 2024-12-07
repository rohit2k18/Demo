@extends('../layout')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title mb-0">Edit Product</h4>
            </div>
            <form action="{{route('products.update', $product)}}" method="POST">
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-sm-6 mb-3">
                            <label for="name" class="form-label">Product Name <span class="red">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" placeholder="Enter Name" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6 mb-3">
                            <label for="price" class="form-label">Product Price<span class="red">*</span></label>
                            <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" placeholder="Enter price" required>
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 mb-3">
                            <label for="stock" class="form-label">Stock Quantity<span class="red">*</span></label>
                            <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{old('stock', $product->stock)}}" required>
                            @error('stock')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12 mb-3">
                            <label for="description" class="form-label">Description <span class="red">*</span></label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror summernote" required>{!!old('description', $product->description)!!}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" id="save" class="btn btn-primary">Submit</button>
                </div>
        </div>
        </form>
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