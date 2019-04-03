<?php

namespace App\Http\Controllers\Auth;

use App\Color;
use App\Product;
use App\ServiceGroups;
use App\Size;
use App\Constants\Common;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\ImageProduct;
use App\Constants\ProductType;
use App\Services;
use App\ProductServiceGroup;
use App\ProductDetailGroups;
use App\ProductDetails;

class productsController extends AppController
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->middleware('auth');
        
    }
    
    public function index(Request $request) {
        return view('auth.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request, $type = '') {
        
        return $this->doSearch($request, new Product(), $type);
    }
    
    /**
     * create
     * @param Request $request
     */
    public function create(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                
                DB::beginTransaction();
                
                try {
                    
                    $data = new Product();
                    $data->name          = Utils::cnvNull($request->name, '');
                    $data->name_url      = Utils::createNameUrl(Utils::cnvNull($request->name, ''));
                    $data->price         = Utils::cnvNull($request->price, '0');
                    $data->category_id   = Utils::cnvNull($request->category_id, '0');
                    $data->vendor_id     = Utils::cnvNull($request->vendor_id, '0');
                    $data->discount      = Utils::cnvNull($request->discount, 0);
                    $data->description   = Utils::cnvNull($request->description, '');
                    $data->status        = Utils::cnvNull($request->status, 0);
                    $data->is_new        = Utils::cnvNull($request->is_new, 0);
                    $data->is_popular        = Utils::cnvNull($request->is_popular, 0);
                    $data->is_best_selling   = Utils::cnvNull($request->is_best_selling, 0);
                    $data->created_at    = date('Y-m-d H:i:s');
                    
                    if($data->save()) {
                        $arrFilenames = [];
                        $filename = '';
                        Utils::doUpload($request, Common::IMAGE_FOLDER, $filename, $data->id, $arrFilenames);
                        
                        $this->addService($data->id, $request);
                        
                        DB::commit();
                        
                        return redirect(route('auth_products_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                    }
                    
                } catch(\Exception $e) {
                    DB::rollBack();
                }
                
            } else {
                return redirect(route('auth_products_create'))->with('error', trans('messages.ERROR'));
            }
        }
        
        return view('auth.form', $this->output);
    }
    
    /**
     * create
     * @param Request $request
     */
    public function edit(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        $data = Product::find($request->id);
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                
                $data->name          = Utils::cnvNull($request->name, '');
                $data->name_url      = Utils::createNameUrl(Utils::cnvNull($request->name, ''));
                $data->price         = Utils::cnvNull($request->price, '0');
                $data->category_id   = Utils::cnvNull($request->category_id, '0');
                $data->vendor_id     = Utils::cnvNull($request->vendor_id, '0');
                $data->discount      = Utils::cnvNull($request->discount, '');
                $data->description   = Utils::cnvNull($request->description, '');
                $data->status        = Utils::cnvNull($request->status, 0);
                $data->is_new        = Utils::cnvNull($request->is_new, 0);
                $data->is_popular        = Utils::cnvNull($request->is_popular, 0);
                $data->is_best_selling   = Utils::cnvNull($request->is_best_selling, 0);
                $data->updated_at    = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    
                    $arrFilenames = [];
                    $filename = '';
                    Utils::doUpload($request, Common::IMAGE_FOLDER, $filename, $data->id, $arrFilenames);
                    
                    $this->addService($data->id, $request);
                    
                    return redirect(route('auth_products_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
            }
        }
        
        $this->output['data'] = $data;
        return view('auth.form', $this->output);
    }
    
    public function remove(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->id;
            $data = Product::find($id);
            if($data->delete()) {
                Services::where('product_id', $id)->delete();
                return redirect(route('auth_products'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
    
    private function addService($productId, $request) {
        $services = $request->service;
        
        if($services != null && $services->count()) {
            ProductDetails::where('product_id', $productId)->delete();
            foreach($services as $key=>$value) {
                
                $items = $value['item'];
                
                if(!count($items)) {
                    continue;
                }
                
                $productDetailGroup               = new ProductDetailGroups();
                $productDetailGroup->name         = strip_tags($value['group_name']);
                $productDetailGroup->created_at   = date('Y-m-d H:i:s');
                
                if($productDetailGroup->save()) {
                    
                    foreach($items as $item) {
                        
                        if(Utils::blank($item['name'])) {
                            continue;
                        }
                        
                        $detail = new ProductDetails();
                        $detail->name = strip_tags($item['name']);
                        $detail->price = strip_tags($item['price']);
                        $detail->product_id = $productId;
                        $detail->product_detail_group_id = $productDetailGroup->id;
                        $detail->save();
                    }
                }
            }
        }
    }
    
}
