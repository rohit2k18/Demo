<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .invoice-header {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .invoice-details {
            margin-top: 20px;
        }
        .invoice-details td {
            padding: 10px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h2>Invoice #{{ $invoice->id }}</h2>
        <p>Date: {{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
    </div>

    <div class="invoice-details">
        <table width="100%">
            <tr>
                <td><strong>Customer Name:</strong> {{ $invoice->customer }}</td>
                <td><strong>Amount:</strong> ${{ number_format($invoice->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($invoice->due_date)->format('F j, Y') }}</td>
                <td><strong>Status:</strong> {{ $invoice->status }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
