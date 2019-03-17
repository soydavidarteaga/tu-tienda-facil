<?php

namespace ProjectEcommerce\Http\Controllers;

use Illuminate\Http\Request;
use ProjectEcommerce\ProductDepartament;
use ProjectEcommerce\ProductCategory;

class ProductDepartamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductDepartament::all();
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
        $departament = ProductDepartament::create($request->all());
        return response()->json(["message" => "Departamento de producto agregado correctamente"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ProductDepartament::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $productDepartament = ProductDepartament::findOrFail($id);
        $productDepartament->fill($request->all());
        $productDepartament->save();
        return response()->json(["message" => "Departamento de producto actualizado correctamente"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productDepartament = ProductDepartament::destroy($id);
        return response()->json(["message" => "Departamento de producto eliminado correctamente"]);
    }
}
