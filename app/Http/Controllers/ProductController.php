<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::latest()->paginate(4);
        return view('product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // * to check the information that the user has entered.
        $request->validate([
            'name'=>'required',
            'price'=>'required',
        ]);

        // * will take everything the user entered and add it to the table in the db.
        $product = Product::create($request->all());
        // * redirect the user to another page after adding the information and showing him a mess.
        return redirect()->route('product.index')->with('success', 'product added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // * to check the information that the user has entered.
        $request->validate([
            'name'=>'required',
            'price'=>'required',
        ]);

        // * will take everything the user entered and add it to the table in the db.
        $product = Product::update($request->all());
        // * redirect the user to another page after adding the information and showing him a mess.
        return redirect()->route('product.index')->with('success', 'product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // * delete the product
        $product->delete();
        // * redirect to index page
        return redirect()->route('product.index')->with('success', 'product deleted successfully');
    }
}
