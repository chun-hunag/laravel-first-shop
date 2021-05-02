<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItem()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     *  Insert Cart by $user_id
     *  @param int $user_id
     *  @return App\Cart
     */
    public static function insertWithUserId(int $user_id) {
        return Cart::create([
                    'user_id' => $user_id,
                    'created_at' => time(),
                    'updated_at' => time()
                ]);
    }

    /**
     * 根據 $user_id 找出該user的 Cart 和 CartItem
     * @param int $user_id
     * @return array
     */
    public static function getCartAndCache(int $user_id, int $cache_second) 
    {
        
        $key = $user_id . 'cart-cache';
        $cart = Cart::with('cartItem')->where('user_id', $user_id)->first()->toArray();
        // 找出產品詳細資訊，後續待優化，一次撈出所有資料過於耗效能，應只撈出必需的部分
        $cart_item = array_map(function ($item) {
            $product_set = Product::getProductAndCache($item['product_id']);
            $product_sku_selected = null;
            $product_sku_array = $product_set['productSkus']->toArray();
            array_walk($product_sku_array, function ($product_sku) use (&$product_sku_selected, $item) {
                if ($product_sku['id'] === $item['product_sku_id']) {
                    $product_sku_selected = $product_sku;
                }
            });
            $item['product'] = $product_set['product'];
            $item['product_sku'] = $product_sku_selected;
            return $item;
        }, $cart['cart_item']);
        $cart['cart_item'] = $cart_item;
        // add cache
        cache([$key => $cart], $cache_second); // chche $cache_second sec
        return $cart;
    }
}
