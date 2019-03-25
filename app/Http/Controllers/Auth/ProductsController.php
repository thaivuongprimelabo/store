<?php

namespace App\Http\Controllers\Auth;

use App\Color;
use App\Product;
use App\Size;
use App\Constants\Common;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\ImageProduct;

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
        return view('auth.products.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request) {
        $wheres = [];
        $output = ['code' => 200, 'data' => ''];
        if($request->isMethod('post')) {
            $id_search = $request->id_search;
            if(!Utils::blank($id_search)) {
                $wheres[] = ['id', '=', $id_search];
            }
            
            $name_search = $request->name_search;
            if(!Utils::blank($name_search)) {
                $wheres[] = ['name', 'LIKE', '%' . $name_search . '%'];
            }
            
            $status_search = $request->status_search;
            if(!Utils::blank($status_search)) {
                $wheres[] = ['status', '=', $status_search];
            }
        }
        
        $products = Product::where($wheres)->orderBy('created_at', 'DESC')->paginate(Common::ROW_PER_PAGE);
        
        $paging = $products->toArray();
        
        if($request->ajax()) {
            $output['data'] = view('auth.products.ajax_list', compact('products', 'paging'))->render();
            return response()->json($output);
        } else {
            return compact('products', 'paging');
        }
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
                
                $product = new Product();
                $product->name          = Utils::cnvNull($request->name, '');
                $product->name_url      = Utils::createNameUrl(Utils::cnvNull($request->name, ''));
                $product->price         = Utils::cnvNull($request->price, '0');
                $product->category_id   = Utils::cnvNull($request->category_id, '0');
                $product->vendor_id     = Utils::cnvNull($request->vendor_id, '0');
                $product->discount      = Utils::cnvNull($request->discount, 0);
                $product->sizes         = !Utils::blank($request->sizes) ? implode(',', $request->sizes) : '';
                $product->colors        = !Utils::blank($request->colors) ? implode(',', $request->colors) : '';
                $product->description   = Utils::cnvNull($request->description, '');
                $product->status        = Utils::cnvNull($request->status, 0);
                $product->is_new        = Utils::cnvNull($request->is_new, 0);
                $product->is_popular        = Utils::cnvNull($request->is_popular, 0);
                $product->is_best_selling   = Utils::cnvNull($request->is_best_selling, 0);
                $product->created_at    = date('Y-m-d H:i:s');
                
                if($product->save()) {
                    $arrFilenames = [];
                    $filename = '';
                    Utils::doUpload($request, Common::IMAGE_FOLDER, $filename, $product->id, $arrFilenames);
                    
                    return redirect(route('auth_products_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_products_create'))->with('error', trans('messages.ERROR'));
            }
        }
        return view('auth.products.create')->withErrors($validator);
    }
    
    /**
     * create
     * @param Request $request
     */
    public function edit(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        $product = Product::find($request->id);
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                
                $product->name          = Utils::cnvNull($request->name, '');
                $product->name_url      = Utils::createNameUrl(Utils::cnvNull($request->name, ''));
                $product->price         = Utils::cnvNull($request->price, '0');
                $product->category_id   = Utils::cnvNull($request->category_id, '0');
                $product->vendor_id     = Utils::cnvNull($request->vendor_id, '0');
                $product->discount      = Utils::cnvNull($request->discount, '');
                $product->sizes         = !Utils::blank($request->sizes) ? implode(',', $request->sizes) : '';
                $product->colors        = !Utils::blank($request->colors) ? implode(',', $request->colors) : '';
                $product->description   = Utils::cnvNull($request->description, '');
                $product->status        = Utils::cnvNull($request->status, 0);
                $product->is_new        = Utils::cnvNull($request->is_new, 0);
                $product->is_popular        = Utils::cnvNull($request->is_popular, 0);
                $product->is_best_selling   = Utils::cnvNull($request->is_best_selling, 0);
                $product->updated_at    = date('Y-m-d H:i:s');
                
                if($product->save()) {
                    
                    $arrFilenames = [];
                    $filename = '';
                    Utils::doUpload($request, Common::IMAGE_FOLDER, $filename, $product->id, $arrFilenames);
                    
                    return redirect(route('auth_products_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
            }
        }
        return view('auth.products.edit', compact('product'))->withErrors($validator);;
    }
    
    public function remove(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->id;
            $product = Product::find($id);
            if($product->delete()) {
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
