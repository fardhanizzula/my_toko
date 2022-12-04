<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // show data
    public function index()
    {
        $data = Product::all();

        // return $data;
        return response()->json([
            "message" => "Load data success",
            "data" => $data
        ], 200);
    }

   // add data
    public function store(Request $request)
    {
        $store = new Product();
        $store->nama_barang = $request->nama_barang;
        $store->merek = $request->merek;
        $store->deskripsi = $request->deskripsi;
        $store->harga = $request->harga;
        $store->jumlah = $request->jumlah;
        $store->stok = $request->stok;
        $store->category_id = $request->category_id;
        $store->save();

        if($store){
            return response()->json([
                "message" => "Create data success",
                "data" => $store
            ], 200);
        }else {
            return ["message" => "Column Cannot be Null!"];
        }
       
    }

    // show by category
    public function show($category)
    {
        $show = Product::where('category', 'like', '%' . $category . '%')->get();
        if($show){
            return response()->json([
                "message" => "Show data Success",
                "data" => $show 
            ]);
        }else{
            return ["message" => "Data not found"];
        }
    }

    // update product
    public function update(Request $request, $id)
    {
        $update = Product::where("id", $id)->update($request->all());
        
        // return $update;
         return response()->json([
            "message" => "Update data success",
            "data" => $update
        ], 200);
    }

    // Category
    public function destroy($id)
    {
        $data = Product::where("id", $id);
        if($data){
            $data->delete();
            return["message" => "Delete Success"];
        }else{
            return["message" => "Data not found"];
        }
    }
}