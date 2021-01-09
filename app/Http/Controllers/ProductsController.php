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
     *  Return product phurchase page
     *  @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request, $id)
    {
        $product = Product::find($id);
        if(is_null( $product)){
            return view('site.index');
        }

        // make sure product is on_sale
        if($product->on_sale != 1){
            return view('site.index');
        }

        // search produckSku
        $productSkus = ProductSku::where('product_id', $product->id)->get();
        if(is_null($productSkus)){
            return view('site.index');
        }
        
        return view('product.product', ['product' => $product, 'productSkus' => $productSkus]);
    }
}
