<?php

namespace App;

use App\Constants\Common;
use App\Helpers\Utils;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = Common::ORDER_DETAILS;
    
    public function getProductInfo() {
        $products = Product::select('id', 'name')->where('id', $this->product_id)->first();
        return $products;
    }
    
    public function getProductDetailList() {
        $orderDetails = OrderDetails::select(
                            'order_details.product_detail_id',
                            'product_details.name',
                            'order_details.qty',
                            'order_details.price',
                            'order_details.cost',
                            'product_detail_groups.name as group_name'
                        )
                        ->leftJoin('product_details', 'product_details.id', '=', 'order_details.product_detail_id')
                        ->leftJoin('product_detail_groups', 'product_detail_groups.id', '=', 'product_details.product_detail_group_id')
                        ->where('order_details.product_id', $this->product_id)
                        ->where('order_details.order_id', $this->order_id)
                        ->where('order_details.product_detail_id', '!=', 0)
                        ->get();
        
        return $orderDetails;
        
    }
    
    public function getPrice() {
        return Utils::formatCurrency($this->price);
    }
    
    public function getCost() {
        return Utils::formatCurrency($this->cost);
    }
}
