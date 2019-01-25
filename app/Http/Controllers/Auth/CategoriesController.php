<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Common;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Category;

class CategoriesController extends Controller
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
        
        $categories = Category::where($wheres)->paginate(Common::ROW_PER_PAGE);
        
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
            
            $maxSize =  Utils::formatMemory(Common::LOGO_MAX_SIZE, true);
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:' . Common::NAME_MAXLENGTH,
            ]);
            
            if (!$validator->fails()) {
                $category = new Category();
                $category->name = $request->input('name', '');
                $category->name_url = $request->input('name', '');
                $category->parent_id = $request->input('parent_id', 0);
                $category->status = $request->input('status', 0);
                $category->created_at = date('Y-m-d H:i:s');
                $category->updated_at = date('Y-m-d H:i:s');
            }
            
            if($category->save()) {
                return redirect(route('auth_categories_create'))->with('success', trans('messages.CREATE_SUCCESS'));
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
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:' . Common::NAME_MAXLENGTH,
            ]);
            
            if (!$validator->fails()) {
                $category = Category::find($request->id);
                $category->name = $request->input('name', '');
                $category->name_url = $request->input('name', '');
                $category->parent_id = $request->input('parent_id', 0);
                $category->status = $request->input('status', 0);
                $category->created_at = date('Y-m-d H:i:s');
                $category->updated_at = date('Y-m-d H:i:s');
            }
            
            if($category->save()) {
                return redirect(route('auth_categories_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
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
