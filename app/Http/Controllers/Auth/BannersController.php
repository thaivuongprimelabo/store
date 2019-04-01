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
            'description' => 'max:' . Common::DESC_MAXLENGTH,
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
        return $this->doSearch($request, new Banner());
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
                Utils::doUpload($request, Common::BANNER_FOLDER, $filename);
                $select_type = Utils::cnvNull($request->select_type, 'use_image');
                
                $data = new Banner();
                if($select_type == 'use_image') {
                    $data->link           = Utils::cnvNull($request->link, '');
                    $data->banner         = $filename;
                } else {
                    $data->youtube_id    = Utils::cnvNull($request->youtube_embed_url, '');
                }
                $data->description    = Utils::cnvNull($request->description, '');
                $data->status         = Utils::cnvNull($request->status, 0);
                $data->select_type    = Utils::cnvNull($request->select_type, 'use_image');
                $data->created_at     = date('Y-m-d H:i:s');
                $data->updated_at     = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    return redirect(route('auth_banners_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_banners_create'))->with('error', trans('messages.ERROR'));
            }
        }
        
        $name = $this->name;
        return view('auth.banners.form', compact('name'));
    }
    
    /**
     * edit
     * @param Request $request
     */
    public function edit(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        $data = Banner::find($request->id);
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                
                $filename = $data->banner;
                Utils::doUpload($request, Common::BANNER_FOLDER, $filename);
                
                $select_type = Utils::cnvNull($request->select_type, 'use_image');
                if($select_type == 'use_image') {
                    $data->link           = Utils::cnvNull($request->link, '');
                    $data->banner         = $filename;
                    $data->youtube_id    = '';
                } else {
                    $data->youtube_id    = Utils::cnvNull($request->youtube_embed_url, '');
                    $data->link           = '';
                    $data->banner         = '';
                }
                
                $data->description    = Utils::cnvNull($request->description, '');
                $data->status         = Utils::cnvNull($request->status, 0);
                $data->select_type    = Utils::cnvNull($request->select_type, 'use_image');
                $data->updated_at     = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    return redirect(route('auth_banners_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_banners_edit', ['id' => $request->id]))->with('error', trans('messages.ERROR'));
            }
        }
        $name = $this->name;
        return view('auth.banners.form', compact('data', 'name'));
    }
    
    public function remove(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->id;
            $data = Banner::find($id);
            if($data->delete()) {
                Utils::removeFile($data->banner);
                return redirect(route('auth_banners'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
}
