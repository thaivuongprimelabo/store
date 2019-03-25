<?php

namespace App\Helpers;
use App\Constants\Common;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Order;
class Cart {

    public static function topCart($cart = null) {
        
        if(is_null($cart)) {
            $cart = [
                'sub_total' => 0,
                'total' => 0,
                'sum_item' => 0,
                'items' => []
            ];
            if(session('cart')) {
                $cart = session('cart');
            }
        }
        return view('shop.common.top_cart', ['cart' => $cart])->render();
    }
    
    public static function mainCart() {
        $cart = [
            'sub_total' => 0,
            'total' => 0,
            'sum_item' => 0,
            'items' => []
        ];
        
        if(session('cart')) {
            $cart = session('cart');
        }
        return view('shop.common.checkout', ['cart' => $cart])->render();
    }
    
    
    public static function addItem($item = []) {
        $cart = [
            'total' => 0,
            'sum_item' => 0,
            'items' => []
        ];
        
        $item['price_discount'] = $item['price'];
        
        if($item['discount']) {
            $item['price_discount'] = Utils::getDiscountPrice($item['price'], $item['discount']);
        }
        
        if(session('cart')) {
            $cart = session('cart');
            
            if(!key_exists($item['id'], $cart)) {
                $cart['items'][$item['id']] = $item;
                self::updateCart($cart);
            } else {
                $cart['items'][$item['id']]['qty'] = $cart['items'][$item['id']]['qty'] + $item['qty'];
            }
        } else {
            $cart['items'][$item['id']] = $item;
            self::updateCart($cart);
        }
        
        return $cart;
    }
    
    public static function removeItem($id) {
        $cart = [
            'total' => 0,
            'sum_item' => 0,
            'items' => []
        ];
        
        if(session('cart')) {
            $cart = session('cart');
            unset($cart['items'][$id]);
            self::updateCart($cart);
        }
        
        return $cart;
    }
    
    public static function updateItem($items) {
        $cart = [
            'total' => 0,
            'sum_item' => 0,
            'items' => []
        ];
        
        if(session('cart')) {
            $cart = session('cart');
            foreach($items as $item) {
                $cart['items'][$item['id']]['qty'] = $item['qty'];
            }
            self::updateCart($cart);
        }
        
        return $cart;
    }
    
    public static function updateCart(&$cart) {
        $total = 0;
        $sum_item = 0;
        $items = $cart['items'];
        foreach($items as $item) {
            $cost = ($item['price_discount'] * $item['qty']);
            $total += $cost;
            $sum_item++;
            $cart['items'][$item['id']]['cost'] = $cost;
        }
        
        $cart['sub_total'] = $total;
        $cart['total'] = $total;
        $cart['sum_item'] = $sum_item;
        
        session(['cart' => $cart]);
        
    }
    
    public static function checkout($checkout) {
        
        $orderId = 0;
        
        if(session('cart')) {
            $cart = session('cart');
            
            DB::beginTransaction();
            
            try {
                
                $order = new Order();
                $order->customer_name       = Utils::cnvNull($checkout['customer_name'], '');
                $order->customer_email      = Utils::cnvNull($checkout['customer_email'], '');
                $order->customer_address    = Utils::cnvNull($checkout['customer_address'], '');
                $order->customer_phone      = Utils::cnvNull($checkout['customer_phone'], '');
                $order->payment_method      = Utils::cnvNull($checkout['payment_method'], '');
                $order->total               = $cart['total'];
                $order->created_at          = date('Y-m-d H:i:s');
                $order->updated_at          = date('Y-m-d H:i:s');
                
                if($order->save()) {
                    $orderDetails = [];
                    foreach($cart['items'] as $item) {
                        $detail = [
                            'order_id'      => $order->id,
                            'product_id'    => $item['id'],
                            'qty'           => $item['qty'],
                            'price'         => $item['price'],
                            'cost'          => $item['cost'],
                            'sizes'         => '',
                            'colors'        => '',
                            'created_at'    => date('Y-m-d H:i:s'),
                            'updated_at'    => date('Y-m-d H:i:s')
                        ];
                        
                        array_push($orderDetails, $detail);
                    }
                    
                    DB::table(Common::ORDER_DETAILS)->insert($orderDetails);
                    
                    $orderId = $order->id;
                }
                
                DB::commit();
                
            }  catch(\Exception $e) {
                DB::rollBack();
            }
        }
        
        if($orderId) {
            session()->remove('cart');
        }
        
        return $orderId;
    }
}
?>