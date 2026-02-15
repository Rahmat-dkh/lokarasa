<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Product::with('category')
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->latest();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category')) {
            $slug = $request->category;
            $category = \App\Models\Category::where('slug', $slug)->first();

            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        $products = $query->paginate(12)->withQueryString();
        return view('products.index', compact('products'));
    }

    public function show(string $id)
    {
        $product = \App\Models\Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
