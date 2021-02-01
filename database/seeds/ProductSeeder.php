<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\ProductSku;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 300 product
        $products = factory(\App\Product::class, 300)->raw();
        Product::insert($products);
        $products = Product::all();
        foreach ($products as $product) {
            // create 3 productSku
            $skus = factory(\App\ProductSku::class, 3)->create(['product_id' => $product->id]);
        }
    }
}
