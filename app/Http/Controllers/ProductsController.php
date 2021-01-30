<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductSku;

class ProductsController extends Controller
{
    


    /**
     *  
     *   @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    }

    /**
     *  Return product data
     *  @return string
     */
    public function getProductById(Request $request, $id)
    {
        $product = Product::find($id);
        if(is_null( $product)){
            return response()->json([
                'result' => 'product is not exist'
            ], 200);
        }

        // make sure product is on_sale
        if($product->on_sale != 1){
            return response()->json([
                'result' => 'product is not on sale'
            ], 200);
        }

        // search produckSku
        $productSkus = ProductSku::where('product_id', $product->id)->get();
        if(is_null($productSkus)){
            return response()->json([
                'result' => 'product is out of stock'
            ], 200);
        }

        $headers = [
            'Content-Type' => 'application/json; charset=utf-8'
        ];
        return response()->json([
            'product' => $product,
            'productSkus' => $productSkus,
            'result' => 'success'
        ], 200, $headers, JSON_UNESCAPED_UNICODE);    
    }
}
