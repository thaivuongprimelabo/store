<?php

namespace App\Http\Controllers\Auth;

use App\Vendor;
use App\Constants\Common;
use App\Constants\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Utils;

class VendorsController extends AppController
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
    public function search(Request $request) {
        return $this->doSearch($request, new Vendor());
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
                Utils::doUploadSimple($request, 'upload_logo', $filename);
                
                $data = new Vendor();
                $data->name           = Utils::cnvNull($request->name, '');
                $data->name_url       = Utils::createNameUrl(Utils::cnvNull($request->name, ''));
                $data->logo           = $filename;
                $data->description    = Utils::cnvNull($request->description, '');
                $data->status         = Utils::cnvNull($request->status, 0);
                $data->created_at     = date('Y-m-d H:i:s');
                $data->updated_at     = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    return redirect(route('auth_vendors_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_vendors_create'))->with('error', trans('messages.ERROR'));
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
        
        $data = Vendor::find($request->id);
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                
                $data = Vendor::find($request->id);
                
                $filename = $data->logo;
                Utils::doUploadSimple($request, 'upload_logo', $filename);
                
                $data->name           = Utils::cnvNull($request->name, '');
                $data->name_url       = Utils::createNameUrl(Utils::cnvNull($request->name, ''));
                $data->logo           = $filename;
                $data->description    = Utils::cnvNull($request->description, '');
                $data->status         = Utils::cnvNull($request->status, 0);
                $data->created_at     = date('Y-m-d H:i:s');
                $data->updated_at     = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    return redirect(route('auth_vendors_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_vendors_create'))->with('error', trans('messages.ERROR'));
            }
        }
        
        $this->output['data'] = $data;
        return view('auth.form', $this->output);
    }
    
    public function remove(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->id;
            $data = Vendor::find($id);
            if($data->delete()) {
                Utils::removeFile($data->logo);
                return redirect(route('auth_vendors'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
    
}
