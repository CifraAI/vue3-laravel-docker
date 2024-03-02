<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $productQuery = Product::query();
        $productQuery->where('title', 'like', '%'.$request->get('q').'%');
        $productQuery->orderBy('title');
        $products = $productQuery->get();

        return [
            'success' => true,
            'products' => $products
        ];
    }

    public function create()
    {
        $this->authorize('create', new Product);

        return [
            'success' => true
        ];
    }

    public function store(Request $request)
    {
        $this->authorize('create', new Product);

        $newProduct = $request->validate([
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newProduct['creator_id'] = auth()->id();

        $product = Product::create($newProduct);

        return redirect()->route('products.show', $product);
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $productData = $request->validate([
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $product->update($productData);

        return redirect()->route('products.show', $product);
    }

    public function destroy(Request $request, Product $product)
    {
        $this->authorize('delete', $product);

        $request->validate(['product_id' => 'required']);

        if ($request->get('product_id') == $product->id && $product->delete()) {
            return redirect()->route('products.index');
        }

        return back();
    }
}
