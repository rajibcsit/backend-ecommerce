<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index()
  {

    $supplier = Supplier::all();
    return response()->json([
      'status' => true,
      'data' => $supplier
    ], 200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    $supplier = $request->all();
    Supplier::create($supplier);
    return response()->json([
      'status' => true,
      'message' => 'Added supplier successfully',
      'data' => $supplier

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
    $supplier = Supplier::FindOrFail($id);

    return  response()->json([
      'data' => $supplier
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
    $supplier = Supplier::FindOrFail($id);

    return response()->json([
      'data' => $supplier
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
    $supplier = Supplier::find($id);

    $supplier->name = $request->name;
    $supplier->description = $request->description;

    $supplier->save();
    return response()->json([
      'status' => true,
      'message' => 'Supplier update successfully',
      'data' => $supplier
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
    $supplier = Supplier::find($id);
    $supplier->delete();

    return response()->json([
      'status' => true,
      'message' => 'Supplier deleted successfully',
      'data' => $supplier
    ]);
  }
}
