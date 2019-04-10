<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
use App\Constants\Common;
use App\Constants\ContactStatus;
use App\Constants\PostStatus;
use App\PostGroups;
use App\Constants\ProductStatus;

class ApiController extends Controller
{
    public $output = ['code' => 404, 'data' => ''];
    
    public function checkExists(Request $request) {
        $value = trim($request->value);
        $col = trim($request->col);
        $table = $request->table;
        $idCheck = $request->id_check;
        $itemName = trans($request->itemName);
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
            case 5: // Post Groups table
                $data = PostGroups::select('id')->where($col, $value)->first();
                break;
            default:
                break;
        }
        
        $check = true;
        
        if($data && $idCheck != $data['id']) {
            $check = false;
        }
        
        $this->output['code'] = 200;
        if(!$check) {
            $this->output['data'] = Utils::getValidateMessage('validation.unique', $itemName);
        }
        
        return response()->json($this->output);
    }
    
    public function updateStatus(Request $request) {
        $id = $request->id;
        $currentStatus = $request->current_status;
        $table = $request->table;
        $object = [];
        switch($table) {
            case Common::VENDORS; // Vendors table
                $object = Vendor::find($id);
                
                break;
            case Common::CATEGORIES; // Categories table
                $object = Category::find($id);
                break;
                
            case Common::BANNERS; // Banners table
                $object = Banner::find($id);
                break;
                
            case Common::CONTACTS; // Contacts table
                $object = Contact::find($id);
                break;
                
            case Common::POSTS; // Posts table
                $object = Post::find($id);
                break;
                
            case Common::USERS; // Users table
                $object = User::find($id);
                break;
                
            case Common::PRODUCTS; // Products table
                $object = Product::find($id);
                break;
                
            case 'postgroups': // Post Groups table
                $object = PostGroups::find($id);
                
            default:
                break;
        }
        
        $object->status = $currentStatus == 1 ? '0' : '1';
        if($object->save()) {
            $this->output['code'] = 200;
            switch($table) {
                case Common::CONTACTS; // Contacts table
                    $this->output['data'] = ['status' => $object->status, 'text' => ContactStatus::getData($object->status)];
                    break;
                
                case Common::POSTS; // Posts table
                    $this->output['data'] = ['status' => $object->status, 'text' => PostStatus::getData($object->status)];
                    break;
                    
                case Common::PRODUCTS; // Posts table
                    $this->output['data'] = ['status' => $object->status, 'text' => ProductStatus::getData($object->status)];
                    break;
                
                default:
                    $this->output['data'] = ['status' => $object->status, 'text' => Status::getData($object->status)];
                    break;
            }
        }
        return response()->json($this->output);
    }
    
    public function loadCity(Request $request) {
        $html = '<option value="" selected>' . trans('shop.checkout.choose_province') . '</option>';
        $city = DB::table('devvn_tinhthanhpho')->orderBy('type')->get();
        
        if($city->count()) {
            foreach($city as $ct) {
                $html .= '<option value="' . $ct->matp . '">' . $ct->name . '</option>';
            }
        }
        
        return $html;
    }
    
    public function loadDistrict(Request $request) {
        
        $html = '<option value="">' . trans('shop.checkout.choose_district') . '</option>';
        
        $cityId = $request->city_id;
        
        $district = DB::table('devvn_quanhuyen')->where('matp', $cityId)->orderBy('type')->get();
        
        if($district->count()) {
            foreach($district as $ct) {
                $html .= '<option value="' . $ct->maqh . '">' . $ct->name . '</option>';
            }
        }
        
        return $html;
        
    }
    
    public function loadWard(Request $request) {
        
        $html = '<option value="">' . trans('shop.checkout.choose_ward') . '</option>';
        
        $districtId = $request->district_id;
        
        $ward = DB::table('devvn_xaphuongthitran')->where('maqh', $districtId)->orderBy('type')->get();
        
        if($ward->count()) {
            foreach($ward as $ct) {
                $html .= '<option value="' . $ct->xaid . '">' . $ct->name . '</option>';
            }
        }
        
        return $html;
    }
    
    public function checkUploadFile(Request $request) {
        $image_mime_type = Common::IMAGE_MIMES;
        $fileSizeLimit = $request->limitUpload;
        if($request->hasFile('fileUpload')) {
            $file = $request->file('fileUpload');
            
            if(!is_array($file)) {
                $mimeType = $request->file('fileUpload')->getMimeType();
                $imageMimeType = explode(',', $image_mime_type);
                
                if(!in_array($mimeType, $imageMimeType)) {
                    return response()->json(['error' => trans('validation.image', ['filename' => $file->getClientOriginalName()])], 500);
                }
                
                $size = $request->file('fileUpload')->getSize();
                if($size > $fileSizeLimit) {
                    return response()->json(['error' => trans('validation.size.file', ['filename' => $file->getClientOriginalName(), 'limit_upload' => Utils::formatMemory($fileSizeLimit)])], 500);
                }
            } else {
                for($i = 0; $i < count($file); $i++) {
                    $f = $file[$i];
                    $mimeType = $f->getMimeType();
                    $imageMimeType = explode(',', $image_mime_type);
                    
                    if(!in_array($mimeType, $imageMimeType)) {
                        return response()->json(['error' => trans('validation.image', ['filename' => $f->getClientOriginalName()])], 500);
                    }
                    
                    $size = $f->getSize();
                    if($size > $fileSizeLimit) {
                        return response()->json(['error' => trans('validation.size.file', ['filename' => $f->getClientOriginalName(), 'limit_upload' => Utils::formatMemory($fileSizeLimit)])], 500);
                    }
                }
            }
        }
    }
    
}
