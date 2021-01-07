<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
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
        return view('product.product', ['product' => $product]);
    }
}
