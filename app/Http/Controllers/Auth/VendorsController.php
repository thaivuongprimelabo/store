<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Vendor;
use App\Constants\Common;
use App\Constants\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Utils;

class VendorsController extends Controller
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
            return ['vendors' => $vendors, 'paging' => $paging];
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
                'size' => Utils::getValidateMessage('validation.size.file', 'auth.vendor.form.logo',  Utils::formatMemory(Common::LOGO_MAX_SIZE)),
            ];
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'logo' => 'image|max:'.$maxSize.'|mimes:jpeg,png,gif'
            ], $messages);
            
            if (!$validator->fails()) {
                
                $filename = '';
                if($request->hasFile('logo')) {
                    
                    $file = $request->logo;
                    
                    $filename = Utils::uploadFile($file, Common::VENDOR_FOLDER);
                }
                
                $vendor = new Vendor();
                $vendor->name = $request->input('name', '');
                $vendor->name_url = $request->input('name', '');
                $vendor->logo = $filename;
                $vendor->description = $request->input('description', '');
                $vendor->status = $request->input('status', 0);
                $vendor->created_at = date('Y-m-d H:i:s');
                $vendor->updated_at = date('Y-m-d H:i:s');
                
                if($vendor->save()) {
                    return redirect(route('auth_vendor_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                }
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
        
        if($request->isMethod('get')) {
            $id = $request->id;
            $vendor = Vendor::find($id);
        }
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'logo' => 'file|mimes:jpeg,png,gif'
            ]);
            
            if (!$validator->fails()) {
                
                $vendor = Vendor::find($request->id);
                
                $filename = $vendor->logo;
                
                if($request->hasFile('logo')) {
                    
                    $file = $request->logo;
                    
                    $filename = Utils::uploadFile($file, Common::VENDOR_FOLDER);
                }
                
                $vendor->name = $request->input('name', '');
                $vendor->name_url = $request->input('name', '');
                $vendor->logo = $filename;
                $vendor->description = $request->input('description', '');
                $vendor->status = $request->input('status', 0);
                $vendor->created_at = date('Y-m-d H:i:s');
                $vendor->updated_at = date('Y-m-d H:i:s');
                
                if($vendor->save()) {
                    return redirect(route('auth_vendor_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
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
                return redirect(route('auth_vendor'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
    
}
