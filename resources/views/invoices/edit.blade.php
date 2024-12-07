@extends('layout')

@section('content')
    <div class="container mt-4">
        <h1>Edit Invoice #{{ $invoice->invoice_no }}</h1>

        <!-- Form to edit the invoice details -->
        <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card mb-4">
                <div class="card-header">
                    <h4>Invoice Details</h4>
                </div>
                <div class="card-body">
                    <!-- Invoice Number -->
                    <div class="form-group">
                        <label for="invoice_no">Invoice No</label>
                        <input type="text" name="invoice_no" class="form-control" value="{{ old('invoice_no', $invoice->invoice_no) }}" required>
                    </div>

                    <!-- Invoice Date -->
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" class="form-control" value="{{ old('date', $invoice->date) }}" required>
                    </div>

                    <!-- Customer Name -->
                    <div class="form-group">
                        <label for="customer">Customer</label>
                        <input type="text" name="customer" class="form-control" value="{{ old('customer', $invoice->customer) }}" required>
                    </div>

                    <!-- Subtotal -->
                    <div class="form-group">
                        <label for="subtotal">Subtotal</label>
                        <input type="number" name="subtotal" class="form-control" value="{{ old('subtotal', $invoice->subtotal) }}" step="0.01" required>
                    </div>
                </div>
            </div>

            <!-- Invoice Items -->
            <div class="card">
                <div class="card-header">
                    <h4>Invoice Items</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="invoice-items-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoice->items as $item)
                                    <tr class="invoice-item-row">
                                        <td>
                                            <select name="items[{{ $loop->index }}][product_id]" class="form-control" required>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" {{ $product->id == $item->product_id ? 'selected' : '' }}>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="items[{{ $loop->index }}][quantity]" class="form-control quantity" value="{{ old('items['.$loop->index.'][quantity]', $item->quantity) }}" min="1" required>
                                        </td>
                                        <td>
                                            <input type="number" name="items[{{ $loop->index }}][price]" class="form-control price" value="{{ old('items['.$loop->index.'][price]', $item->price) }}" step="0.01" required>
                                        </td>
                                        <td>
                                            <input type="number" name="items[{{ $loop->index }}][total_price]" class="form-control total-price" value="{{ old('items['.$loop->index.'][total_price]', $item->total_price) }}" step="0.01" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm remove-item-btn">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-success" id="add-item-btn">Add Item</button>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Invoice</button>
                <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <!-- JS for dynamic row manipulation -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Handle adding new items
            const addItemButton = document.getElementById('add-item-btn');
            addItemButton.addEventListener('click', function () {
                const tableBody = document.querySelector('#invoice-items-table tbody');
                const newRow = document.createElement('tr');
                newRow.classList.add('invoice-item-row');
                newRow.innerHTML = `
                    <td>
                        <select name="items[][product_id]" class="form-control" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="items[][quantity]" class="form-control quantity" value="1" min="1" required>
                    </td>
                    <td>
                        <input type="number" name="items[][price]" class="form-control price" value="0.00" step="0.01" required>
                    </td>
                    <td>
                        <input type="number" name="items[][total_price]" class="form-control total-price" value="0.00" step="0.01" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-item-btn">Remove</button>
                    </td>
                `;
                tableBody.appendChild(newRow);
            });

            // Handle removing items
            document.querySelector('#invoice-items-table').addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-item-btn')) {
                    e.target.closest('tr').remove();
                }
            });

            // Update total price when quantity or price is changed
            document.querySelector('#invoice-items-table').addEventListener('input', function (e) {
                if (e.target && (e.target.classList.contains('quantity') || e.target.classList.contains('price'))) {
                    const row = e.target.closest('tr');
                    const quantity = row.querySelector('.quantity').value;
                    const price = row.querySelector('.price').value;
                    const totalPrice = (quantity * price).toFixed(2);
                    row.querySelector('.total-price').value = totalPrice;
                }
            });
        });
    </script>
@endsection
