<?php

namespace App;

use App\Constants\Common;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
    
    public function getFirstImage($thumb = 'medium') {
        $image_url = Utils::getImageLink();
        $image_product = ImageProduct::select('image','medium')->where('product_id', $this->id)->first();
        if($image_product) {
            $image_url = Utils::getImageLink($image_product->image, $image_product->$thumb);
        }
        return $image_url;
    }
    
    public function getAllImage($id = '') {
        $output = [];
        $image_product = ImageProduct::select('id', 'image')->where('product_id', $this->id)->get();
        foreach($image_product as $image) {
            $image_url = Utils::getImageLink($image->image);
            $output[$image->id] = $image_url;
        }
        return $output;
    }
    
    public function getImageDetails() {
        $image_product = ImageProduct::where('product_id', $this->id)->get();
        return $image_product;
    }
    
    public function getCategoryName() {
        $category = Category::select('name')->where('id', $this->category_id)->first();
        return $category ? $category->name : '';
    }
    
    public function getCategoryLink() {
        $category = Category::select('name_url')->where('id', $this->category_id)->first();
        return $category ? route('category', ['slug' => $category->name_url]) : '';
    }
    
    public function getVendorName() {
        $vendor = Vendor::select('name')->where('id', $this->vendor_id)->first();
        return $vendor ? $vendor->name : '';
    }
    
    public function getServices() {
        $details = ProductDetails::select(
                            'product_detail_groups.id AS group_id', 
                            'product_detail_groups.name AS group_name', 
                            DB::raw('GROUP_CONCAT(product_details.name ORDER BY product_details.id) AS service_names'), 
                            DB::raw('GROUP_CONCAT(product_details.price ORDER BY product_details.id) AS service_prices')
                        )
                        ->join('product_detail_groups', 'product_detail_groups.id', '=', 'product_details.product_detail_group_id')
                        ->where('product_details.product_id', $this->id)
                        ->groupBy('product_detail_groups.id', 'product_detail_groups.name')
                        ->get();
        
        $html = '';
        $table = view('auth.products.details', ['details' => $details])->render();
        $html .= $table;
        
        return $html;
    }
    
    public function getDiscount($price, $discount) {
        return number_format($price - ($price * ($discount / 100)));
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getPrice() {
        if(is_numeric($this->price)) {
            return Utils::formatCurrency($this->price);
        } else {
            return $input;
        }
        return '';
    }
    
    public function getSummary() {
        return $this->summary;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function getLink() {
        return route('product_details',['slug' => $this->name_url]);
    }
    
    public function getImageWidth() {
        return '280';
    }
    
    public function getImageHeight() {
        return '280';
    }
}
