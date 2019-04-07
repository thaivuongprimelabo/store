<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Product;
use App\Helpers\Cart;
use App\Helpers\CartItem;
use App\Helpers\Utils;
use App\Order;
use Carbon\Carbon;
use App\Constants\Common;
use App\Constants\StatusOrders;
use App\OrderDetails;
use App\Constants\ProductType;
use App\ProductDetails;

class CartController extends AppController
{
    public $breadcrumb = [];
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->breadcrumb = [route('home') => trans('shop.home')];
    }
    
    public function index(Request $request) {

        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => 'Giỏ hàng']
        ];

        return view('shop.cart', $this->output);
    }
    
    public function addToCart(Request $request) {
        $result = [];
        if($request->ajax()) {
            $pid = $request->pid;
            $id = $request->id;
            $qty = $request->qty;
            $item_type = $request->item_type;
            $cart = Cart::getInstance($request->getSession());
            if($item_type != ProductType::IS_DETAIL_ITEM) {
                $product = Product::find($pid);
                
                if($product) {
                    $cartItem = new CartItem();
                    $cartItem->setId($product->id);
                    $cartItem->setName($product->getName());
                    $cartItem->setImage($product->getFirstImage('small'));
                    $cartItem->setQty($qty);
                    $cartItem->setPrice($product->price);
                    $cartItem->setLink($product->getLink());
                    
                    $cart->addItem($cartItem);
                }
            } else {
                $productDetail = ProductDetails::find($id);
                
                $detailItem = new CartItem();
                $detailItem->setId($productDetail->id);
                $detailItem->setName($productDetail->name);
                $detailItem->setQty(1);
                $detailItem->setPrice($productDetail->price);
                
                $cart->addDetailItem($pid, $detailItem);
                
            }
            
            $result['#cart_1'] = view('shop.common.cart_item', ['cart' => $cart])->render();
            $result['.cartCount2'] = $cart->getCount();
            $result['#top_cart'] = $cart->getTopCart();
            return response()->json($result);
        }
        
        return response()->json($result);
    }
    
    public function updateCart(Request $request) {
        $result = [];
        if($request->ajax()) {
            $id = $request->id;
            $qty = $request->qty;
            
            $cart = Cart::getInstance($request->getSession());
            $cart->updateCart($id, $qty);
            
            $result['.cartCount2'] = $cart->getCount();
            $result['#top_cart'] = $cart->getTopCart();
            $result['#main_cart'] = $cart->getMainCart();
            return response()->json($result);
        }
    }
    
    public function removeItem(Request $request) {
        $result = [];
        if($request->ajax()) {
            $id = $request->id;
            
            $cart = Cart::getInstance($request->getSession());
            $cart->removeItem($id);
            
            $result['.cartCount2'] = $cart->getCount();
            $result['#top_cart'] = $cart->getTopCart();
            $result['#main_cart'] = $cart->getMainCart();
            return response()->json($result);
        }
    }
    
    public function checkout(Request $request) {
        
        if(!$request->session()->has('cart')) {
            return redirect('/');
        }
        
        if($request->ajax()) {
            
            $result = [];
            
            $cart = Cart::getInstance($request->getSession());
            
            DB::beginTransaction();
            
            try {
                
                $order = [
                    'customer_name' => Utils::cnvnull($request->customer_name, ''),
                    'customer_email' => Utils::cnvnull($request->customer_email, ''),
                    'customer_phone' => Utils::cnvnull($request->customer_phone, ''),
                    'customer_address' => Utils::cnvnull($request->customer_address, ''),
                    'customer_address' => Utils::cnvnull($request->customer_address, ''),
                    'customer_province' => Utils::cnvnull($request->customer_province, ''),
                    'customer_district' => Utils::cnvnull($request->customer_district, ''),
                    'customer_note' => Utils::cnvnull($request->customer_note, ''),
                    'payment_method' => Utils::cnvnull($request->payment_method, ''),
                    'status' => StatusOrders::ORDER_NEW,
                    'total' => $cart->getTotal(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                
                $id = DB::table(Common::ORDERS)->insertGetId($order);
                
                if($id) {
                    $cart->setCheckoutInfo($order);
                    $orderDetails = [];
                    
                    foreach($cart->getCart() as $cartItem) {
                        
                        $detail = [
                            'order_id' => $id,
                            'product_id' => $cartItem->getId(),
                            'qty' => $cartItem->getQty(),
                            'price' => $cartItem->getPrice(),
                            'cost' => $cartItem->getCost(),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                        
                        array_push($orderDetails, $detail);
                    }
                    
                    DB::table(Common::ORDER_DETAILS)->insert($orderDetails);
                }
                
                $result['checkout_result'] = true;
                
                DB::commit();
            } catch(\Exception $e) {
                $result['checkout_result'] = false;
                DB::rollBack();
            }
            
            return response()->json($result);
        }
        
        return view('shop.checkout', $this->output);
    }
    
    public function checkoutSuccess(Request $request) {
        $cart = Cart::getInstance($request->getSession());
        $cart->destroy();
        return view('shop.checkout_success', $this->output);
    }
}
