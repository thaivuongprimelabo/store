<?php

namespace App\Http\Controllers\Auth;

use App\Banner;
use App\Constants\Common;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannersController extends AppController
{
    public $rules = [];
    
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->rules = [
            'link' => 'url|max:' . Common::LINK_MAXLENGTH,
            'description' => 'max:' . Common::DESC_MAXLENGTH,
            'banner' => 'image|max:' . Utils::formatMemory($this->config['config']['banner_maximum_upload'], true) .'|mimes:'. Common::IMAGE_EXT1,
        ];
    }
    
    public function index(Request $request) {
        return view('auth.banners.index', $this->search($request));
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
        
        $banners = Banner::where($wheres)->orderBy('created_at', 'DESC')->paginate(Common::ROW_PER_PAGE);
        
        $paging = $banners->toArray();
        
        if($request->ajax()) {
            $output['data'] = view('auth.banners.ajax_list', compact('banners', 'paging'))->render();
            return response()->json($output);
        } else {
            return compact('banners', 'paging');
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
                
                $filename = '';
                if($request->hasFile('banner')) {
                    
                    $file = $request->banner;
                    
                    $filename = Utils::uploadFile($file, Common::BANNER_FOLDER);
                }
                
                $banner = new Banner();
                $banner->link           = Utils::cnvNull($request->link, '');
                $banner->banner         = $filename;
                $banner->description    = Utils::cnvNull($request->description, '');
                $banner->status         = Utils::cnvNull($request->status, 0);
                $banner->created_at     = date('Y-m-d H:i:s');
                $banner->updated_at     = date('Y-m-d H:i:s');
                
                if($banner->save()) {
                    return redirect(route('auth_banners_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_banners_create'))->with('error', trans('messages.ERROR'));
            }
        }
        return view('auth.banners.create')->withErrors($validator);
    }
    
    /**
     * edit
     * @param Request $request
     */
    public function edit(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        $banner = Banner::find($request->id);
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                
                $filename = $banner->banner;
                if($request->hasFile('banner')) {
                    
                    $file = $request->banner;
                    
                    $filename = Utils::uploadFile($file, Common::BANNER_FOLDER);
                }
                
                $banner->link           = Utils::cnvNull($request->link, '');
                $banner->banner         = $filename;
                $banner->description    = Utils::cnvNull($request->description, '');
                $banner->status         = Utils::cnvNull($request->status, 0);
                $banner->updated_at     = date('Y-m-d H:i:s');
                
                if($banner->save()) {
                    return redirect(route('auth_banners_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_banners_edit', ['id' => $request->id]))->with('error', trans('messages.ERROR'));
            }
        }
        return view('auth.banners.edit', compact('banner'))->withErrors($validator);
    }
    
    public function remove(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->id;
            $banner = Banner::find($id);
            if($banner->delete()) {
                Utils::removeFile($banner->banner);
                return redirect(route('auth_banners'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
}
