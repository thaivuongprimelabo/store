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

class productsController extends AppController
{
    
    public $rules = [];
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->middleware('auth');
        
        $this->rules = [
            'name' => 'required|max:' . Common::NAME_MAXLENGTH,
            'price' => 'required|max:' . Common::PRICE_MAXLENGTH,
//             'category_id' => 'required',
//             'vendor_id' => 'required',
            'image' => 'image|max:' . Utils::formatMemory(Common::IMAGE_MAX_SIZE, true) . '|mimes:'. Common::IMAGE_EXT1
        ];
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
                
                $this->addService(0, $request);
                
                DB::beginTransaction();
                
                try {
                    
                    $data = new Product();
                    $data->name          = Utils::cnvNull($request->name, '');
                    $data->name_url      = Utils::createNameUrl(Utils::cnvNull($request->name, ''));
                    $data->price         = Utils::cnvNull($request->price, '0');
                    $data->category_id   = Utils::cnvNull($request->category_id, '0');
                    $data->vendor_id     = Utils::cnvNull($request->vendor_id, '0');
                    $data->discount      = Utils::cnvNull($request->discount, 0);
                    $data->sizes         = !Utils::blank($request->sizes) ? implode(',', $request->sizes) : '';
                    $data->colors        = !Utils::blank($request->colors) ? implode(',', $request->colors) : '';
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
        
        $name = $this->name;
        return view('auth.products.create', compact('name'))->withErrors($validator);
    }
    
    private function addService($productId, $request) {
        $services = $request->service;
        
        if(count($services)) {
            DB::table('services')->where('product_id', $productId)->delete();
            foreach($services as $key=>$value) {
                
                $serviceGroup               = new ServiceGroups();
                $serviceGroup->name         = strip_tags($value['group_name']);
                $serviceGroup->created_at   = date('Y-m-d H:i:s');
                
                if($serviceGroup->save()) {
                    
                    $items = $value['item'];
                    
                    foreach($items as $item) {
                        $service = new Services();
                        $service->name = strip_tags($item['name']);
                        $service->price = strip_tags($item['price']);
                        $service->product_id = $productId;
                        $service->service_group_id = $serviceGroup->id;
                        $service->created_at   = date('Y-m-d H:i:s');
                        $service->save();
                        
                        if($service->save()) {
                        }
                    }
                }
            }
        }
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
                $data->sizes         = !Utils::blank($request->sizes) ? implode(',', $request->sizes) : '';
                $data->colors        = !Utils::blank($request->colors) ? implode(',', $request->colors) : '';
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
        
        $name = $this->name;
        return view('auth.products.edit', compact('data', 'name'));
    }
    
    public function remove(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->id;
            $data = Product::find($id);
            if($data->delete()) {
                return redirect(route('auth_products'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
    
    public function sizes(Request $request) {
        return view('auth.products.sizes.index', $this->searchSizeColor($request, Common::SIZES));
    }
    
    public function colors(Request $request) {
        return view('auth.products.colors.index', $this->searchSizeColor($request, Common::COLORS));
    }
    
    public function removeSize(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->id;
            $size = Size::find($id);
            if($size->delete()) {
                return redirect(route('auth_products_sizes'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
    
    public function removeColor(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->id;
            $color = Color::find($id);
            if($color->delete()) {
                return redirect(route('auth_products_colors'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
    
    public function searchSizeColor(Request $request, $table = '') {
        $wheres = [];
        $output = ['code' => 200, 'data' => ''];
        
        if($table == Common::COLORS) {
            $colors = Color::where($wheres)->orderBy('created_at', 'DESC')->get();
            
            if($request->ajax()) {
                $output['data'] = view('auth.colors.ajax_list', compact('colors', 'paging'))->render();
                return response()->json($output);
            } else {
                return compact('colors');
            }
        } else {
            $sizes = Size::where($wheres)->get();
            
            if($request->ajax()) {
                $output['data'] = view('auth.sizes.ajax_list', compact('sizes', 'paging'))->render();
                return response()->json($output);
            } else {
                return compact('sizes');
            }
        }
    }
    
}
