<?php

namespace App;

use App\Constants\Common;
use App\Helpers\Utils;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = Common::ORDERS;
    
    public function getOrderDetails() {
        $orderDetails = OrderDetails::select(
                            'order_details.order_id',
                            'order_details.product_id',
                            'order_details.product_detail_id',
                            'order_details.qty',
                            'order_details.price',
                            'order_details.cost'
                        )
                        ->where('order_details.order_id', $this->id)
                        ->where('order_details.product_detail_id', 0)
                        ->get();
        
        return $orderDetails;
    }
    
    public function getTotal() {
        return Utils::formatCurrency($this->total);
    }
    
}
