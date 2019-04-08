<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class Cart {

    private $cart = [];
    private $total = 0;
    private $totalFormat = 0;
    private $count = 0;
    private $cartItem = null;
    private $session = null;
    private $checkoutInfo = null;
    public static $instance;
    
    public function __construct() {
        self::$instance = self::$instance;
    }
    
    public static function getInstance($session) {
        if (self::$instance === null) {
            if($session->has('cart')) {
                self::$instance = $session->get('cart');
            } else {
                self::$instance = new self();
            }
            
            self::$instance->session = $session;
        }
        return self::$instance;
    }
    
    public function getCart() {
        return $this->cart;
    }
    
    public function setCart($_cart) {
        $this->cart = $_cart;
        if(!count($this->cart)) {
            $this->session->remove('cart');
        } else {
            $this->session->put('cart', $this);
        }
    }
    
    public function setCheckoutInfo($_info) {
        $this->checkoutInfo = $_info;
    }
    
    public function setCount($_count) {
        $this->count = $_count;
    }
    
    public function getTotal() {
        $this->total = 0;
        foreach($this->cart as $cartItem) {
            $this->total += $cartItem->getCostIncludeDetail();
        }
        return $this->total;
    }
    
    public function getCheckoutInfo() {
        return $this->checkoutInfo;
    }
    
    public function getTotalFormat() {
        return Utils::formatCurrency($this->getTotal());
    }
    
    public function addItem(CartItem $cartItem) {
        $flg = false;
        foreach($this->cart as $cItem) {
            if($cItem->getId() == $cartItem->getId()) {
                $cItem->setQty($cartItem->getQty());
                $cItem->setDetailList($cartItem->getDetailList());
                $flg = true;
                break;
            }
        }
        if(!$flg) {
            array_push($this->cart, $cartItem);
        }
        $this->cartItem = $cartItem;
        $this->session->put('cart', $this);
    }
    
    public function addDetailItem($id, CartItem $detailItem) {
        foreach($this->cart as $cartItem) {
            if($cartItem->getId() == $id) {
//                 $detailList = [];
//                 array_push($detailList, $detailItem);
                $cartItem->addDetailItem($detailItem);
                break;
            }
        }
        
        $this->cartItem = $cartItem;
        $this->session->put('cart', $this);
    }
    
    public function getCartItem() {
        return $this->cartItem;
    }
    
    public function getCount() {
        $this->count = count($this->cart);
        return $this->count;
    }
    
    public function getTopCart() {
        return view('shop.common.top_cart', ['cart' => $this])->render();
    }
    
    public function getMainCart() {
        return view('shop.common.main_cart', ['cart' => $this])->render();
    }
    
    public function updateCart($id, $qty) {
        foreach($this->cart as $cartItem) {
            if($cartItem->getId() == $id) {
                $cartItem->setQty($qty);
            }
        }
        
        $this->session->put('cart', $this);
    }
    
    public function removeItem($id) {
        $cart = [];
        foreach($this->cart as $cartItem) {
            if($cartItem->getId() != $id) {
                array_push($cart, $cartItem);
            }
        }
        
        $this->setCart($cart);
    }
    
    public function removeDetailItem($pid, $id) {
        foreach($this->cart as $cartItem) {
            if($cartItem->getId() == $pid) {
                $detailList = [];
                foreach($cartItem->getDetailList() as $detail) {
                    if($detail->getId() != $id) {
                        array_push($detailList, $detail);
                    }
                }
                
                $cartItem->setDetailList($detailList);
            }
        }
        
        $this->setCart($this->cart);
    }
    
    public function destroy() {
        $this->session->remove('cart');
    }
}
?>