<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Vendor;
use App\Constants\Common;
use App\Constants\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Utils;

class VendorsController extends AppController
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
            'description' => 'max:' . Common::DESC_MAXLENGTH,
            'logo' => 'image|max:' . Utils::formatMemory(Common::LOGO_MAX_SIZE, true) . '|mimes:'. Common::IMAGE_EXT1
        ];
    }
    
    public function index(Request $request) {
        return view('auth.vendors.index', $this->search($request));
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
        
        $vendors = Vendor::where($wheres)->paginate(Common::ROW_PER_PAGE);
        
        $paging = $vendors->toArray();
        
        if($request->ajax()) {
            $output['data'] = view('auth.vendors.ajax_list', compact('vendors', 'paging'))->render();
            return response()->json($output);
        } else {
            return compact('vendors', 'paging');
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
                if($request->hasFile('logo')) {
                    
                    $file = $request->logo;
                    
                    $filename = Utils::uploadFile($file, Common::VENDOR_FOLDER);
                }
                
                $vendor = new Vendor();
                $vendor->name           = Utils::cnvNull($request->name, '');
                $vendor->name_url       = Utils::cnvNull($request->name, '');
                $vendor->logo           = $filename;
                $vendor->description    = Utils::cnvNull($request->description, '');
                $vendor->status         = Utils::cnvNull($request->status, 0);
                $vendor->created_at     = date('Y-m-d H:i:s');
                $vendor->updated_at     = date('Y-m-d H:i:s');
                
                if($vendor->save()) {
                    return redirect(route('auth_vendors_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_vendors_create'))->with('error', trans('messages.ERROR'));
            }
        }
        return view('auth.vendors.create')->withErrors($validator);
    }
    
    /**
     * create
     * @param Request $request
     */
    public function edit(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        $vendor = Vendor::find($request->id);
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                
                $vendor = Vendor::find($request->id);
                
                $filename = $vendor->logo;
                
                if($request->hasFile('logo')) {
                    
                    $file = $request->logo;
                    
                    $filename = Utils::uploadFile($file, Common::VENDOR_FOLDER);
                }
                
                $vendor->name           = Utils::cnvNull($request->name, '');
                $vendor->name_url       = Utils::cnvNull($request->name, '');
                $vendor->logo           = $filename;
                $vendor->description    = Utils::cnvNull($request->description, '');
                $vendor->status         = Utils::cnvNull($request->status, 0);
                $vendor->created_at     = date('Y-m-d H:i:s');
                $vendor->updated_at     = date('Y-m-d H:i:s');
                
                if($vendor->save()) {
                    return redirect(route('auth_vendors_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_vendors_create'))->with('error', trans('messages.ERROR'));
            }
        }
        return view('auth.vendors.edit', compact('vendor'))->withErrors($validator);;
    }
    
    public function remove(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->id;
            $vendor = Vendor::find($id);
            if($vendor->delete()) {
                Utils::removeFile($vendor->logo);
                return redirect(route('auth_vendors'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
    
}
