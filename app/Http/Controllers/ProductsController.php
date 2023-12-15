<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact(
            'products'
        ));
    }

    public function stock()
    {
        $products = Product::all();

        return view('products.stock', compact(
            'products'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact(
            'categories'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string'
            ],
            'description' => [
                'string'
            ],
            'expires_at' => [
                'nullable',
                'date',
                'after:now'
            ],
            'price' => [
                'required',
                'integer'
            ],
            'image' => [
                'required',
                'file',
                'max:5120',
                'mimes:png,jpg,jpeg'
            ],
        ]);

        $data = $request->all();

        /** @var \Illuminate\Http\UploadedFile $image */
        $image = $request->image;
        $path = $image->store('products', 'public');

        $data['image'] = "/storage/{$path}";

        $product = Product::create($data);

        return redirect()->route('products.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $categories = Category::all();

        return view('products.edit', compact(
            'product',
            'categories'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required',
                'string'
            ],
            'description' => [
                'string'
            ],
            'expires_at' => [
                'nullable',
                'date',
                'after:now'
            ],
            'price' => [
                'required',
                'integer'
            ],
            'image' => [
                'file',
                'max:5120',
                'mimes:png,jpg,jpeg'
            ]
        ]);

        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $data = $request->all();

        if ( isset($request->image) ) {
            /** @var \Illuminate\Http\UploadedFile $image */
            $image = $request->image;
            $path = $image->store('products', 'public');

            $data['image'] = "/storage/{$path}";
        }

        $product->update($data);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}
