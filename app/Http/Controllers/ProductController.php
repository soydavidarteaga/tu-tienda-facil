<?php

namespace ProjectEcommerce\Http\Controllers;

use Illuminate\Http\Request;
use ProjectEcommerce\ProductCategory;
use ProjectEcommerce\Product;
use ProjectEcommerce\ProductImage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    public function getProductImage($code){
        return ProductImage::where('code',$code)->get();
    }

    public function updateProductImage(Request $request,$code){
        $productImage = new ProductImage;
        $productImage->code = $code;
        $file = $request->file('file');
        $file_name = str_random(6).".".$file->getClientOriginalExtension();
        $file->move(public_path()."/img/products",$file_name);
        $productImage->url = '/img/products/'.$file_name;
        $productImage->save();
        return response()->json(["message" => "updated"]);
    }

    public function destroyProductImage($id){
        ProductImage::destroy($id);
        return response()->json(["message" => "destroyed"]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json(["message" => "success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Product::findOrFail($id);
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
        $product = Product::findOrFail($id);
        $product->fill($request->all());
        $product->save();
        return response()->json(["message" => "success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json(["message" => "success"]);
    }
}
