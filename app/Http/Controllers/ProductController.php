<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display a list of products
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function getProductItems($id)
    {
        $product = Product::with('items')->find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json(['items' => $product->items], 200);
    }

    // Show a single product
    public function show($product)
    {
        $product=Product::find(decrypt($product));
        return view('products.show', compact('product'));
    }

    // Show the form for creating a new product
    public function create()
    {
        return view('products.create');
    }

    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'required',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Show the form for editing the product
    public function edit($product)
    {
        $product=Product::find(decrypt($product));
        return view('products.edit', compact('product'));
    }

    // Update the product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Delete the product
    public function destroy(Product $product)
    {
        $product->delete();
        return 'success';
    }
}