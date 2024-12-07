@extends('layout')

@section('content')
<div class="container">
    <h2>Create Invoice</h2>

    <form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="invoice_no">Invoice No</label>
            <input type="text" class="form-control" id="invoice_no" name="invoice_no" value="{{ old('invoice_no') }}" required>
        </div>

        <div class="form-group">
            <label for="invoice_logo">Invoice Logo</label>
            <input type="file" class="form-control" id="invoice_logo" name="invoice_logo">
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
        </div>

        <div class="form-group">
            <label for="customer">Customer</label>
            <input type="text" class="form-control" id="customer" name="customer" value="{{ old('customer') }}" required>
        </div>

        <div class="form-group">
            <label for="subtotal">Subtotal</label>
            <input type="number" class="form-control" id="subtotal" name="subtotal" value="{{ old('subtotal') }}" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="product_id">Product</label>
            <select class="form-control" id="product_id" name="product_id" required>
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }} (₹{{ number_format($product->price, 2) }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="items">Items</label>
            <div id="items">
                <!-- Empty items container to start -->
            </div>
            <button type="button" class="btn btn-secondary" id="add-item">Add Item</button>
        </div>

        <button type="submit" class="btn btn-primary">Create Invoice</button>
    </form>
</div>

<script>
    let itemCount = 0; // Start with zero items

    // Fetch items dynamically when a product is selected
    document.getElementById('product_id').addEventListener('change', function() {
        const productId = this.value;
        if (!productId) return;

        // AJAX request to fetch items
        fetch(`/products/${productId}/items`)
            .then(response => response.json())
            .then(data => {
                const itemsContainer = document.getElementById('items');
                itemsContainer.innerHTML = ''; // Clear existing items

                data.items.forEach((item, index) => {
                    const itemRow = document.createElement('div');
                    itemRow.classList.add('item-row', 'mb-2');
                    itemRow.innerHTML = `
                        <input type="text" class="form-control mb-1" name="items[${index}][description]" value="${item.description}" placeholder="Item description" required>
                        <input type="number" class="form-control mb-1" name="items[${index}][quantity]" value="${item.quantity}" placeholder="Quantity" required>
                        <input type="number" class="form-control mb-1" name="items[${index}][price]" value="${item.price}" placeholder="Price" required>
                        <button type="button" class="btn btn-danger remove-item">Remove</button>
                    `;
                    itemsContainer.appendChild(itemRow);
                });

                itemCount = data.items.length; // Update item count
            })
            .catch(error => console.error('Error fetching items:', error));
    });

    // Add new item row manually
    document.getElementById('add-item').addEventListener('click', function() {
        const newItem = document.createElement('div');
        newItem.classList.add('item-row', 'mb-2');
        newItem.innerHTML = `
            <input type="text" class="form-control mb-1" name="items[${itemCount}][description]" placeholder="Item description" required>
            <input type="number" class="form-control mb-1" name="items[${itemCount}][quantity]" placeholder="Quantity" required>
            <input type="number" class="form-control mb-1" name="items[${itemCount}][price]" placeholder="Price" required>
            <button type="button" class="btn btn-danger remove-item">Remove</button>
        `;
        document.getElementById('items').appendChild(newItem);
        itemCount++;
    });

    // Remove item row
    document.getElementById('items').addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('remove-item')) {
            event.target.closest('.item-row').remove();
        }
    });
</script>
@endsection
