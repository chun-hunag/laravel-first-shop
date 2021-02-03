<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'products';

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
}
