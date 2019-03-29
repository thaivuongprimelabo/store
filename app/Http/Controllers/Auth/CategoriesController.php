<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Common;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Category;

class CategoriesController extends AppController
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
        ];
    }
    
    public function index(Request $request) {
        return view('auth.categories.index', $this->search($request));
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
        
        $categories = Category::where($wheres)->orderBy('created_at', 'DESC')->paginate(Common::ROW_PER_PAGE);
        
        $paging = $categories->toArray();
        
        if($request->ajax()) {
            $output['data'] = view('auth.categories.ajax_list', compact('categories', 'paging'))->render();
            return response()->json($output);
        } else {
            return compact('categories', 'paging');
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
                $category = new Category();
                $category->name         = Utils::cnvNull($request->name, '');
                $category->name_url     = Utils::createNameUrl(Utils::cnvNull($request->name, ''));
                $category->parent_id    = Utils::cnvNull($request->parent_id, 0);
                $category->status       = Utils::cnvNull($request->status, 0);
                $category->created_at   = date('Y-m-d H:i:s');
                $category->updated_at   = date('Y-m-d H:i:s');
                
                if($category->save()) {
                    return redirect(route('auth_categories_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_categories_create'))->with('error', trans('messages.ERROR'));
            }
        }
        
        return view('auth.categories.create')->withErrors($validator);
    }
    
    /**
     * edit
     * @param Request $request
     */
    public function edit(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        $category = Category::find($request->id);
        
        if($request->isMethod('post')) {
            
            $maxSize =  Utils::formatMemory(Common::LOGO_MAX_SIZE, true);
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                $category = Category::find($request->id);
                $category->name         = Utils::cnvNull($request->name, '');
                $category->name_url     = Utils::createNameUrl(Utils::cnvNull($request->name, ''));
                $category->parent_id    = Utils::cnvNull($request->parent_id, 0);
                $category->status       = Utils::cnvNull($request->status, 0);
                $category->updated_at   = date('Y-m-d H:i:s');
                
                if($category->save()) {
                    return redirect(route('auth_categories_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_categories_edit', ['id' => $request->id]))->with('error', trans('messages.ERROR'));
            }
            
        }
        
        return view('auth.categories.edit', compact('category'))->withErrors($validator);
    }
    
    public function remove(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->id;
            $Category = Category::find($id);
            if($Category->delete()) {
                return redirect(route('auth_categories'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
}
