<?php

namespace App\Http\Controllers\Auth;

use App\Product;
use App\Constants\Common;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class productsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        if($request->isMethod('Product')) {
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
        
        $products = Product::where($wheres)->paginate(Common::ROW_PER_PAGE);
        
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
            
            $maxSize =  Utils::formatMemory(Common::LOGO_MAX_SIZE, true);
            
            $messages = [
                'size' => Utils::getValidateMessage('validation.size.file', 'auth.products.form.image',  Utils::formatMemory(Common::IMAGE_MAX_SIZE)),
            ];
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:' . Common::NAME_MAXLENGTH,
                'description' => 'required|max:' . Common::DESC_MAXLENGTH,
                'image[]' => 'image|max:'.$maxSize.'|mimes:'. Common::IMAGE_EXT1
            ], $messages);
            
            if (!$validator->fails()) {
                
                $product = new Product();
                $product->name = $request->input('name', '');
                $product->name_url = $request->input('name', '');
                $product->price = $request->input('price', '0');
                $product->category_id = $request->input('category_id', '0');
                $product->vendor_id = $request->input('vendor_id', '0');
                $product->description = $request->input('description', '');
                $product->status = $request->input('status', 0);
                $product->created_at = date('Y-m-d H:i:s');
                
                if($product->save()) {
                    $arrFilenames = [];
                    if($request->hasFile('image_upload')) {
                        
                        $files = $request->image_upload;
                        
                        if(count($files)) {
                            for($i = 0; $i < count($files); $i++) {
                                $file = $files[$i];
                                $filename = Utils::uploadFile($file, Common::IMAGE_FOLDER);
                                array_push($arrFilenames, ['product_id' => $product->id, 'image' => $filename]);
                            }
                            
                            DB::table(Common::IMAGES_PRODUCT)->insert($arrFilenames);
                        }
                    }
                    
                    return redirect(route('auth_products_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                }
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
            
            $messages = [
                'size' => Utils::getValidateMessage('validation.size.file', 'auth.products.form.image',  Utils::formatMemory(Common::IMAGE_MAX_SIZE)),
            ];
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'image' => 'file|mimes:jpeg,png,gif'
            ], $messages);
            
            if (!$validator->fails()) {
                
                $product = Product::find($request->id);
                
                $filename = $product->image;
                
                if($request->hasFile('image')) {
                    
                    $file = $request->image;
                    
                    $filename = Utils::uploadFile($file, Common::IMAGE_FOLDER);
                }
                
                $product->name = $request->input('name', '');
                $product->name_url = $request->input('name', '');
                $product->image = $filename;
                $product->price = $request->input('price', '0');
                $product->category_id = $request->input('category_id', '0');
                $product->vendor_id = $request->input('vendor_id', '0');
                $product->description = $request->input('description', '');
                $product->status = $request->input('status', 0);
                $product->created_at = date('Y-m-d H:i:s');
                $product->updated_at = date('Y-m-d H:i:s');
                
                if($product->save()) {
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
//                 Utils::removeFile($product->logo);
                return redirect(route('auth_products'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
}
