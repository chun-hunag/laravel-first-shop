<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'products';

    public const CACHE_TIME = 30; // 30 seconds


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'title', 'description', 'on_sale', 'cover_image', 'images', 'rating', 'sold_count', 'review_count', 'price', 'sort_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['stock_number'];
    
    
    /**
     * images mutator
     */
    public function setCoverImageAttribute($cover_image)
    {
        if(!array_key_exists( 'id', $this->attributes)){
            // insert
            $id = $this->getNextId();
            $dir_name = '/upload/images/products/' .  $id;
            if (!is_dir(public_path() . $dir_name)) {
                //Create our directory if it does not exist
                mkdir(public_path() . $dir_name);
            }
            $dir_name .= '/';
            $str_arr = explode('/', $cover_image);
            $image_name = $str_arr[count($str_arr) - 1];
            $new_dir_name = $dir_name . $image_name;
            rename( public_path() . '/upload/' . $cover_image, public_path() . $new_dir_name);
            $this->attributes['cover_image'] = explode('/upload', $new_dir_name)[1];
            return;
        }
        // edit
        $this->attributes['cover_image'] = $cover_image;
    

    }

    /**
     * images mutator
     */
    public function setImagesAttribute($images)
    {
        if(!array_key_exists( 'id', $this->attributes)){
            // insert
            $id = $this->getNextId();
            $dir_name = '/upload/images/products/' . $id;
            if (!is_dir(public_path() . $dir_name)) {
                //Create our directory if it does not exist
                mkdir(public_path() . $dir_name);
            }
            $dir_name .= '/';
            $new_images = [];
            if (is_array($images)) {
                foreach($images as $index => $image){
                    // remove file and set new image path array
                    $str_arr = explode('/', $image);
                    $image_name = $str_arr[count($str_arr) - 1];
                    $new_dir_name = $dir_name . $image_name;
                    rename( public_path() . '/upload/' . $image, public_path() . $new_dir_name);
                    $new_images[$index] = explode('/upload', $new_dir_name)[1]; 
                }
            }
            $this->attributes['images'] = json_encode($new_images);
            return;
        }
        // edit
        $this->attributes['images'] = json_encode($images);
    }
    /**
     * images accessor
     */
    public function getImagesAttribute($images)
    {
        return json_decode($images, true);
    }

    public function sort()
    {
        return $this->belongsTo(Sort::class);
    }


    public function productSkus()
    {
        return $this->hasMany(ProductSku::class);
    }

    /** 
     * get next db id
     */
    public function getNextId() 
    {

        $statement = DB::select("show table status like 'products'");

        return $statement[0]->Auto_increment;
    }

    /**
     *  若有快取則取得Product 快取，沒有就撈取後建立
     *  @param int $id
     *  @param array
     */
    public static function getProductCacheOrSet(int $id)
    {
        $key = Product::getCacheKey($id);

        $product_set = cache($key);
        if (isset($product_set)) {
            return $product_set;
        }

        return Product::getProductAndCache($id); // 取得產品資訊並快取

    } 

    /**
     *  撈取產品資料，然後建立快取
     *  @param int $id
     *  @return array
     */
    public static function getProductAndCache(int $id)
    {
        $product = Product::find($id);
        if(is_null($product)){
            return [];
        }
        // make sure product is on_sale
        if($product->on_sale != 1){
            return [];
        }

        // search produckSku
        $productSkus = ProductSku::where('product_id', $id)->get();
        if(is_null($productSkus)){
            return [];
        }

        $product_set = ['product' => $product, 'productSkus' => $productSkus];
        $key = Product::getCacheKey($id);
        cache([$key => $product_set], Product::CACHE_TIME); // chche
        return $product_set;
    }

    /**
     *  get product cache key by id
     *  @param int $id
     *  @param string 
     */
    public static function getCacheKey(int $id) 
    {
        return 'product-' . $id;
    } 

    
}
