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

class AccessoriesController extends AppController
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
            'image' => 'image'
        ];
    }
    
    public function index(Request $request) {
        return view('auth.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request) {
        
        return $this->doSearch($request, new Product(), 'toy');
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
                $data->is_toy        = Utils::cnvNull($request->is_toy, 0);
                $data->created_at    = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    $arrFilenames = [];
                    $filename = '';
                    Utils::doUpload($request, Common::IMAGE_FOLDER, $filename, $data->id, $arrFilenames);
                    
                    return redirect(route('auth_products_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_products_create'))->with('error', trans('messages.ERROR'));
            }
        }
        
        $name = $this->name;
        return view('auth.products.create', compact('name'))->withErrors($validator);
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
                $data->is_toy        = Utils::cnvNull($request->is_toy, 0);
                $data->updated_at    = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    
                    $arrFilenames = [];
                    $filename = '';
                    Utils::doUpload($request, Common::IMAGE_FOLDER, $filename, $data->id, $arrFilenames);
                    
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
}
