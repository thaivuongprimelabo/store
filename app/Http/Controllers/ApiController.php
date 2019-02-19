<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Vendor;
use App\Constants\Status;
use App\Helpers\Utils;
use App\Category;
use App\Color;
use App\Contact;
use App\Post;
use App\Product;
use App\User;
use App\Size;
use App\Helpers\Cart;

class ApiController extends Controller
{
    public $output = ['code' => 404, 'data' => ''];
    
    public function checkExists(Request $request) {
        $value = trim($request->value);
        $col = trim($request->col);
        $table = $request->table;
        $idCheck = $request->id_check;
        $check = false;
        switch($table) {
            case 0; // Vendors table
                $data = Vendor::select('id')->where($col, $value)->first();
                
                break;
            case 1; // Categories table
                $data = Category::select('id')->where($col, $value)->first();
                break;
            case 2; // Products table
                $data = Product::select('id')->where($col, $value)->first();
                break;
            case 3; // Posts table
                $data = Post::select('id')->where($col, $value)->first();
                break;
            case 4; // Users table
                $data = User::select('id')->where($col, $value)->first();
                break;
            default:
                break;
        }
        
        if($data) {
            $check = true;
            
            if(!Utils::blank($idCheck) && $idCheck == $data['id']) {
                $check = false;
            }
        }
        
        if(!$check) {
            echo 'true';
        } else {
            echo 'false';
        }
        exit;
    }
    
    public function updateStatus(Request $request) {
        $id = $request->id;
        $currentStatus = $request->current_status;
        $table = $request->table;
        $object = [];
        switch($table) {
            case 0; // Vendors table
            $object = Vendor::find($id);
                
                break;
            case 1; // Categories table
                $object = Category::find($id);
                break;
                
            case 2; // Banners table
                $object = Banner::find($id);
                break;
                
            case 3; // Contacts table
                $object = Contact::find($id);
                break;
                
            case 4; // Posts table
                $object = Post::find($id);
                break;
                
            case 5; // Users table
                $object = User::find($id);
                break;
                
            case 6; // Products table
                $object = Product::find($id);
                break;
                
            case 7; // Sizes table
                $object = Size::find($id);
                break;
                
            case 8; // Colors table
                $object = Color::find($id);
                break;
            
            default:
                break;
        }
        
        $object->status = $currentStatus == 1 ? '0' : '1';
        if($object->save()) {
            $this->output['code'] = 200;
            $this->output['data'] = ['status' => $object->status, 'text' => Status::getData($object->status)];
        }
        return response()->json($this->output);
    }
    
    public function sizes(Request $request) {
        $id = $request->id;
        if(Utils::blank($id)) {
            $size = new Size();
            $size->created_at = date('Y-m-d H:i:s');
        } else {
            $size = Size::find($id);
        }
        
        $size->name = Utils::cnvNull($request->name, '');
        $size->status = Utils::cnvNull($request->status, 1);
        $size->updated_at = date('Y-m-d H:i:s');
        
        if($size->save()) {
            $this->output['code'] = 200;
            $this->output['data'] = $size;
        }
        
        return response()->json($this->output);
    }
    
    public function colors(Request $request) {
        $id = $request->id;
        if(Utils::blank($id)) {
            $color = new Color();
            $color->created_at = date('Y-m-d H:i:s');
        } else {
            $color = Color::find($id);
        }
        
        $color->name = Utils::cnvNull($request->name, '');
        $color->status = Utils::cnvNull($request->status, 1);
        $color->updated_at = date('Y-m-d H:i:s');
        
        if($color->save()) {
            $this->output['code'] = 200;
            $this->output['data'] = $color;
        }
        
        return response()->json($this->output);
    }
    
    public function addItem(Request $request) {
        $item = $request->item;
        $cart = Cart::addItem($item);
        $this->output['code'] = 200;
        $this->output['top_cart'] = Cart::topCart($cart);
        $this->output['main_cart'] = Cart::mainCart($cart);
        return response()->json($this->output);
    }
    
    public function removeItem(Request $request) {
        $id = $request->id;
        $cart = Cart::removeItem($id);
        if(!count($cart['items'])) {
            $this->output['code'] = 404;
            return response()->json($this->output);
        }
        
        $this->output['code'] = 200;
        $this->output['top_cart'] = Cart::topCart($cart);
        $this->output['main_cart'] = Cart::mainCart($cart);
        return response()->json($this->output);
    }
    
    public function updateItem(Request $request) {
        $items = $request->items;
        $cart = Cart::updateItem($items);
        $this->output['code'] = 200;
        $this->output['top_cart'] = Cart::topCart($cart);
        $this->output['main_cart'] = Cart::mainCart($cart);
        return response()->json($this->output);
    }
    
    public function checkout(Request $request) {
        $checkout = $request->checkout;
        $orderId = Cart::checkout($checkout);
        $this->output['code'] = 200;
        $this->output['order_id'] = $orderId;
        return response()->json($this->output);
    }
}
