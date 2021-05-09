<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cart_id', 'product_id', 'product_sku_id', 'amount'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function product()
    {
        return $this->hasOne(ProductSku::class);
    }

    public function productSku()
    {
        return $this->hasOne(ProductSku::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     *  找出same product_id, product_sku_id, cart_id 's  cart_item
     *  @param int $cart_id
     *  @param int $product_id
     *  @param int $product_sku_id
     *  @return null|CartItem
     */
    public static function findCartItem(int $cart_id, int $product_id, int $product_sku_id)
    {
        return CartItem::where('product_id', $product_id)
                             ->where('product_sku_id', $product_sku_id)
                             ->where('cart_id', $cart_id)
                             ->first();
    }

}
