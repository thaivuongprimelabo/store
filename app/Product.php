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
    
    public function getCategoryName() {
        $category = Category::select('name')->where('id', $this->category_id)->first();
        return $category ? $category->name : '';
    }
    
    public function getVendorName() {
        $vendor = Vendor::select('name')->where('id', $this->vendor_id)->first();
        return $vendor ? $vendor->name : '';
    }
    
    public function getServices() {
        $services = Services::select(
                            'service_groups.id AS group_id', 
                            'service_groups.name AS group_name', 
                            DB::raw('GROUP_CONCAT(services.name) AS service_names'), 
                            DB::raw('GROUP_CONCAT(services.price) AS service_prices')
                        )
                        ->join('service_groups', 'service_groups.id', '=', 'services.service_group_id')
                        ->where('services.product_id', $this->id)
                        ->groupBy('service_groups.id', 'service_groups.name')
                        ->get();
        
        $html = '';
        $table = view('auth.products.services', ['services' => $services])->render();
        $html .= $table;
        
        return $html;
    }
    
    public function getSizes($productSizes) {
        $arrSizes = explode(',', $productSizes);
        $sizes = Size::select('name')->whereIn('id', $arrSizes)->get();
        $html = '';
        if($sizes->count()) {
            $html .= '<ul class="size-option">';
            $html .= '<li><span class="text-uppercase">' . trans('shop.size') . '</span></li>';
            foreach($sizes as $size) {
                $html .= '<li><a href="#">' . $size['name'] . '</a></li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }
    
    public function getColors($productColors) {
        $arrColors = explode(',', $productColors);
        $colors = Color::select('name')->whereIn('id', $arrColors)->get();
        $html = '';
        if($colors->count()) {
            $html .= '<ul class="color-option">';
            $html .= '<li><span class="text-uppercase">' . trans('shop.color') . '</span></li>';
            foreach($colors as $color) {
                $html .= '<li><a href="#" style="background-color:'. $color['name'] . ';"></a></li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }
    
    public function getDiscount($price, $discount) {
        return number_format($price - ($price * ($discount / 100)));
    }
    
    public function getPrice() {
        if(is_numeric($this->price)) {
            return Utils::formatCurrency($this->price);
        } else {
            return $input;
        }
        return '';
    }
}
