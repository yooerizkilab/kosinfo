<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ApiproductController extends Controller
{
    // get all
    public function index()
    {
        return Product::all();
    }

    // create product
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'harga' => 'required'
        ]);

        return Product::create($request->all());
    }

    // get product by id
    public function show($id)
    {
        return Product::find($id);
    }

    // update product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    // delet product
    public function destroy($id)
    {
        return Product::destroy($id);
    }

    // search product by jenis
    public function search($jenis)
    {
        return Product::where('jenis', 'like', '%' . $jenis . '%')->get();
    }
}
