<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function All_Products(){
        return Product::all();
    }
    public function GetProduct($id){
        $product = Product::find($id);
        return $product;
    }
    public function CreateProduct(Request $request){
        $data = $request->validate([
            'product_name'=>'required',
            'product_desc'=>'required',
            'product_price'=>'required'
        ]);

        $product = Product::create([
            "product_name"=>$data['product_name'],
            "product_desc"=>$data['product_desc'],
            "product_price"=>$data['product_price']
        ]);
        /*
        $product = Product::create([
            "product_name"=>$request->product_name,
            "product_desc"=>$request->product_desc,
            "product_price"=>$request->product_price
        ]);
        */
        //$product->save();
        //return redirect()->route('AllProducts');
        return response($product,201);
    }
    public function ModifyProduct(Request $request,$id_pro){
        $prod = Product::find($id_pro);
        $prod->update([
            "product_name"=>$request->product_name,
            "product_desc"=>$request->product_desc,
            "product_price"=>$request->product_price
        ]);
        return response($prod,201);
    }
    public function DeleteProduct($id_pro){
        $prod = Product::find($id_pro);
        $prod->delete();
        return response()->json(['msg'=>'product deleted succcessfully']);
    }
    public function Search($name_pro){
        return Product::where('product_name','like','%'.$name_pro.'%')->get();
    }
}
