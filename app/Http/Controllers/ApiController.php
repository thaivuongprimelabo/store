<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Vendor;
use App\Constants\Status;
use App\Helpers\Utils;
use App\Category;
use App\Contact;
use App\Post;
use App\Product;

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
}
