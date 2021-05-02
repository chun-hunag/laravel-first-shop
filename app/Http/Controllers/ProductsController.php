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
     *  Search product
     *  @return string
     */
    public function search(Request $request)
    {
        $limit = 30;
        $page = 1; 
        $sort = ''; 
        $text = '';

        if ($request->has('text')) {
            $text =  $request->query('text');
        }
        $product = Product::select('id', 'title', 'cover_image', 'rating', 'sold_count', 'review_count', 'price', 'sort_id')
                        ->where('on_sale', 1)
                        ->where('title', 'like', '%' . $text . '%');

        if ($request->has('sort')) {
            $sort =  $request->query('sort');
            $product = $product->where('sort', $sort);
        }
        $count = $product->count();

        if ( $request->has(['limit', 'page'])) {
            $limit = $request->query('limit');
            $page = $request->query('page');
        }
        
        $product = $product->skip(( $page - 1 ) * $limit)->take($limit);
        $products = $product->get();

        $headers = [
            'Content-Type' => 'application/json; charset=utf-8'
        ];
        return response()->json(
            [
                'count' => $count,
                'products' => $products
            ]
        , 200,  $headers, JSON_UNESCAPED_UNICODE);
    }


    /**
     *  Return product data
     *  @return string
     */
    public function getProductById(Request $request, $id)
    {
        $product_set = Product::getProductCacheOrSet($id);

        $headers = [
            'Content-Type' => 'application/json; charset=utf-8'
        ];
        return response()->json($product_set , 200, $headers, JSON_UNESCAPED_UNICODE);    
    }

}
