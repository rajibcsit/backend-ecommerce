<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('category', 'supplier')->get();
        foreach ($product as $key => $value) {
            $product[$key]['image'] = Storage::url($value['image']);
        }

        return response()->json([
            'status' => true,
            'data' => $product
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $product = $request->all();

        if ($request->file('image')) {
            $product['image'] = Storage::putFile('product', $request->file('image'));
        }
        // return $product;
        Product::create($product);

        return  response()->json([
            'status' => true,
            'message' => 'Product added successfully',
            'data' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::FindOrFail($id);
        if ($product->image) {
            Storage::url($product->image);
        }
        return response()->json([
            'data' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product  = Product::FindOrFail($id);
        if ($product->image) {
            Storage::url($product->image);
        }
        return response()->json([
            'data' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if ($request->file("image")) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $product['image'] = Storage::putFile('product', $request->file('image'));
        }

        $product->name        = $request->name;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->description = $request->description;
        $product->price       = $request->price;

        $product->save();

        return response()->json([
            'status' => true,
            'message' => 'Product update successfuly',
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::Find($id);
        if ($product->image) {
            Storage::delete($product->image);
        }
        $product->delete();
        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully',
            'data' => $product
        ]);
    }
}
