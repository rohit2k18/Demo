@extends('layout')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Invoices</h1>
        <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">Create Invoice</a>
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Invoice No</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Subtotal</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->invoice_no }}</td>
                            <td>{{ $invoice->customer }}</td>
                            <td>{{ \Carbon\Carbon::parse($invoice->date)->format('d M, Y') }}</td>
                            <td>${{ number_format($invoice->subtotal, 2) }}</td>
                            <td>
                                <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('invoice.download', $invoice->id) }}" class="btn btn-warning btn-sm">download</a>
                                <a href="{{ route('invoice.send', $invoice->id) }}" class="btn btn-warning btn-sm">send</a>
                                
                                <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this invoice?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
