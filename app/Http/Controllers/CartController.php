<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\CartItem;
use App\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     *  Get user's cart
     *  @return json
     */
    public function index(Request $request)
    {
        // setting header
        $headers = ['Content-Type' => 'application/json; charset=utf-8'];
        $user_id = Auth::user()->id;

        // check cache
        $key = $user_id . 'cart-cache';
        $cart = cache($key);
        if (!isset($cart)) {
            $cart = Cart::getCartAndCache($user_id, 300); // get cart content and cache
        }

        return response()->json($cart, 200,  $headers, JSON_UNESCAPED_UNICODE);
    }

    /**
     *  Insert cart item to user's cart
     *  @param int $product_id
     *  @param int $product_sku_id
     *  @param int $amount
     *  @return json
     */
    public function addCartItem(Request $request)
    {
        // setting header
        $headers = ['Content-Type' => 'application/json; charset=utf-8'];

        $post = $request->post();
        // params check
        if (!isset($post['product_id']) || !isset($post['product_sku_id']) || !isset($post['amount'])) {
            return response()->json(['message' => 'param is missing'], 400,  $headers, JSON_UNESCAPED_UNICODE);
        }
        
        $user_id = Auth::user()->id;
        // cart check
        // find user's cart
        $cart = Cart::where('user_id', $user_id)->first();
        if (!isset($cart)) { // didn't find cart
            $cart = Cart::insertWithUserId($user_id);
        }
        // produck_sku check
        // insert
        $cart_item = CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $post['product_id'],
            'product_sku_id' => $post['product_sku_id'],
            'amount' => $post['amount'],
            'created_at' => time(),
            'updated_at' => time()
        ]);
        $cart_item->save();
        
        $cart = [];
        // renew cache
        $cart = Cart::getCartAndCache($user_id, 300); 

        return response()->json($cart, 200,  $headers, JSON_UNESCAPED_UNICODE);
    }

    /**
     *  移除使用者購物車品項
     *  @param int $cart_item_id
     */
    public function removeCartItme(Request $request, $cart_item_id)
    {
        // setting header
        $headers = ['Content-Type' => 'application/json; charset=utf-8'];
        // params check
        if (!isset($cart_item_id)) {
            return response()->json(['message' => 'param is missing'], 400,  $headers, JSON_UNESCAPED_UNICODE);
        }

        $user_id = Auth::user()->id;
        // cart check
        // find user's cart
        $cart = Cart::where('user_id', $user_id)->first();
        if (!isset($cart)) { // didn't find cart
            return response()->json([ 'message' => 'cart not found'], 404,  $headers, JSON_UNESCAPED_UNICODE);
        }
        
        $cart_item = CartItem::where('cart_id', $cart->id)->where('id', $cart_item_id)->first();
        // cant find cart_item
        if (!isset($cart_item)) {
            return response()->json([ 'message' => 'cart itemt not found'], 404,  $headers, JSON_UNESCAPED_UNICODE); 
        }
        // delete cart_item
        $is_deleted = $cart_item->delete();
        // 
        if (!$is_deleted) {
            return response()->json([ 'message' => 'delete failed'], 200,  $headers, JSON_UNESCAPED_UNICODE); 
        }

        $cart = Cart::getCartAndCache($user_id, 300); 
        return response()->json($cart, 200,  $headers, JSON_UNESCAPED_UNICODE); 
    }
}
