<?php

namespace App;

use App\Constants\Common;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Utils;

class Product extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = Common::PRODUCTS;
    
    public function getFirstImage($id) {
        $image_url = Utils::getImageLink();
        $image_product = ImageProduct::select('image')->where('product_id', $id)->first();
        if($image_product) {
            $image_url = Utils::getImageLink($image_product->image);
        }
        return $image_url;
    }
    
    public function getAllImage($id) {
        $output = [];
        $image_product = ImageProduct::select('id', 'image')->where('product_id', $id)->get();
        foreach($image_product as $image) {
            $image_url = Utils::getImageLink($image->image);
            $output[$image->id] = $image_url;
        }
        return $output;
    }
    
    public function getPrice($input) {
        if(is_numeric($input)) {
            return number_format($input);
        } else {
            return $input;
        }
        return '';
    }
}
