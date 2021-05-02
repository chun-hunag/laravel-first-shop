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
}
