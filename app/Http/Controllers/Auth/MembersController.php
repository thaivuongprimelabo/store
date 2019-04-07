<?php

namespace App\Http\Controllers\Auth;

use App\Member;
use App\Constants\Common;
use App\Constants\UserRole;
use App\Helpers\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;

class MembersController extends AppController
{
    //
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
            'name' => 'required',
        ];
        
    }
    
    public function index(Request $request) {
        return view('auth.index', $this->search($request, 'members'));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request, $type) {
        return $this->doSearch($request, new User(), 'members');
    }
    
    /**
     * create
     * @param Request $request
     */
    public function create(Request $request) {
        
        $validator = [];
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if ($validator->fails()) {
                return redirect(route('auth_members_edit', ['id' => $request->id]))->with('error', trans('messages.ERROR'));
            }
            
            $filename = '';
            Utils::doUpload($request, Common::AVATAR_FOLDER, $filename);
            
            $data = new User();
            $data->name = Utils::cnvNull($request->name, '');
            $data->email = Utils::cnvNull($request->email, '');
            $data->password = Hash::make(Utils::cnvNull($request->password, ''));
            $data->avatar = $filename;
            $data->role_id = UserRole::MEMBERS;
            $data->status = Utils::cnvNull($request->status, 0);
            $data->created_at = date('Y-m-d H:i:s');
            $data->updated_at = date('Y-m-d H:i:s');
            
            if($data->save()) {
                return redirect(route('auth_members_create'))->with('success', trans('messages.UPDATE_SUCCESS'));
            }
        }
        
        return view('auth.form', $this->output);
        
    }
    
    /**
     * search
     * @param Request $request
     */
    public function edit(Request $request, $type) {
        $request->flash();
        
        $validator = [];
        
        $data = User::find($request->id);
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if ($validator->fails()) {
                return redirect(route('auth_members_edit', ['id' => $request->id]))->with('error', trans('messages.ERROR'));
            }
            
            $filename = '';
            Utils::doUpload($request, Common::AVATAR_FOLDER, $filename);
            
            $data->name = Utils::cnvNull($request->name, '');
            $data->email = Utils::cnvNull($request->email, '');
            if(!Utils::blank($request->password)) {
                $data->password = Hash::make(Utils::cnvNull($request->password, ''));
            }
            if(!Utils::blank($filename)) {
                $data->avatar = $filename;
            }
            $data->status = Utils::cnvNull($request->status, 0);
            $data->updated_at = date('Y-m-d H:i:s');
            
            if($data->save()) {
                return redirect(route('auth_members_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
            }
        }
        
        $this->output['data'] = $data;
        return view('auth.form', $this->output);
    }
    
    public function remove(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->id;
            $data = Member::find($id);
            if($data->delete()) {
                return redirect(route('auth_members'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
}
