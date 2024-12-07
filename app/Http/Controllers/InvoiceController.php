<?php
namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use App\Models\Product; // Assuming you have a Product model to handle product list
use PDF;
use Mail;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('items')->get();
        return view('invoices.index', compact('invoices'));
    }

    public function create()
        {
            $products = Product::select('id', 'name', 'price')->get();
            return view('invoices.create', compact('products'));
        }

        public function store(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'invoice_no' => 'required|unique:invoices,invoice_no',
            'date' => 'required|date',
            'customer' => 'required|string',
            'subtotal' => 'required|numeric|min:0',
            'product_id' => 'nullable|exists:products,id',
            'invoice_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
            'items' => 'nullable|array', // Optional items array
            'items.*.description' => 'required_with:items|string',
            'items.*.quantity' => 'required_with:items|integer|min:1',
            'items.*.price' => 'required_with:items|numeric|min:0',
        ]);

        // Handle invoice logo upload
        $invoiceLogoPath = null;
        if ($request->hasFile('invoice_logo')) {
            $invoiceLogoPath = $request->file('invoice_logo')->store('invoices', 'public');
        }

        // Create the invoice
        $invoice = Invoice::create([
            'invoice_no' => $validatedData['invoice_no'],
            'invoice_logo' => $invoiceLogoPath,
            'date' => $validatedData['date'],
            'customer' => $validatedData['customer'],
            'subtotal' => $validatedData['subtotal'],
            'product_id' => $validatedData['product_id'],
        ]);

        // Handle invoice items if provided
        if (!empty($validatedData['items'])) {
            foreach ($validatedData['items'] as $item) {
                $invoice->items()->create($item);
            }
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully!');
    }         

        public function getProductItems($id)
        {
            $product = Product::findOrFail($id);
            $items = $product->items; // Assuming `items` is a relationship on the Product model
        
            return response()->json(['items' => $items]);
        }
        

    public function edit(Invoice $invoice)
    {
        $products = Product::all();
        return view('invoices.edit', compact('invoice', 'products'));
    }

    public function update(Request $request, Invoice $invoice)
{
    // Validate the incoming request
    $data = $request->validate([
        'invoice_no' => 'required|unique:invoices,invoice_no,' . $invoice->id,
        'date' => 'required|date',
        'customer' => 'required|string',
        'subtotal' => 'required|numeric',
        'items' => 'required|array',
        'items.*.description' => 'required|string',
        'items.*.quantity' => 'required|numeric|min:1', 
        'items.*.price' => 'required|numeric|min:0', 
    ]);

    // Update the invoice details
    $invoice->update([
        'invoice_no' => $data['invoice_no'],
        'date' => $data['date'],
        'customer' => $data['customer'],
        'subtotal' => $data['subtotal'],
    ]);

    // Delete existing items
    $invoice->items()->delete();

    // Loop through each item and add it to the invoice
    foreach ($data['items'] as $item) {
        $invoice->items()->create([
            'description' => $item['description'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);
    }

    // Redirect with success message
    return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully!');
}

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully!');
    }

    public function download($id)
    {
        // Retrieve the invoice from the database
        $invoice = Invoice::findOrFail($id);
        // dd($invoice);
        // Pass the invoice data to the view
        $pdf = PDF::loadView('invoices.pdf', compact('invoice'));
        // Return the generated PDF as a download
        return $pdf->download("invoice_{$id}.pdf");
    }

    public function sendPdf($id)
    {
        $invoice = Invoice::findOrFail($id);

        $pdf = PDF::loadView('invoices.pdf', compact('invoice'));

        Mail::send([], [], function ($message) use ($invoice, $pdf) {
            $message->to('rohit.rai889@gmail.com')
                ->subject('Invoice - ' . $invoice->invoice_no)
                ->attachData($pdf->output(), 'invoice.pdf');
        });

        return back()->with('success', 'Invoice sent successfully!');
    }
}
