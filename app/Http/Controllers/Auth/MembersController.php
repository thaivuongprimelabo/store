<?php

namespace App\Http\Controllers\Auth;

use App\Member;
use App\Constants\Common;
use App\Helpers\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        return view('auth.members.index', $this->search($request, 'members'));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request, $type) {
        $wheres = [];
        $output = ['code' => 200, 'data' => ''];
        
        if($request->isMethod('post')) {
            $id_search = $request->id_search;
            if(!Utils::blank($id_search)) {
                $wheres[] = ['id', '=', $id_search];
            }
        }
        
        $members = Member::where($wheres)->orderBy('created_at', 'DESC')->paginate(Common::ROW_PER_PAGE);
        
        $paging = $members->toArray();
        
        if($request->ajax()) {
            $output['data'] = view('auth.members.ajax_list', compact('members', 'paging'))->render();
            return response()->json($output);
        } else {
            return compact('members', 'paging');
        }
        
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
            
            $member = new Member();
            $member->name = Utils::cnvNull($request->name, '');
            $member->email = Utils::cnvNull($request->email, '');
            $member->password = Hash::make(Utils::cnvNull($request->password, ''));
            $member->avatar = $filename;
            $member->status = Utils::cnvNull($request->status, 0);
            $member->created_at = date('Y-m-d H:i:s');
            $member->updated_at = date('Y-m-d H:i:s');
            
            if($member->save()) {
                return redirect(route('auth_members_create'))->with('success', trans('messages.UPDATE_SUCCESS'));
            }
        }
        
        return view('auth.members.create');
        
    }
    
    /**
     * search
     * @param Request $request
     */
    public function edit(Request $request, $type) {
        $request->flash();
        
        $validator = [];
        
        $member = Member::find($request->id);
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if ($validator->fails()) {
                return redirect(route('auth_members_edit', ['id' => $request->id]))->with('error', trans('messages.ERROR'));
            }
            
            $filename = '';
            Utils::doUpload($request, Common::AVATAR_FOLDER, $filename);
            
            $member->name = Utils::cnvNull($request->name, '');
            $member->email = Utils::cnvNull($request->email, '');
            if(!Utils::blank($request->password)) {
                $member->password = Hash::make(Utils::cnvNull($request->password, ''));
            }
            if(!Utils::blank($filename)) {
                $member->avatar = $filename;
            }
            $member->status = Utils::cnvNull($request->status, 0);
            $member->updated_at = date('Y-m-d H:i:s');
            
            if($member->save()) {
                return redirect(route('auth_members_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
            }
        }
        
        return view('auth.members.edit', compact('member'));
    }
    
    public function remove(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->id;
            $member = Member::find($id);
            if($member->delete()) {
                return redirect(route('auth_members'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
}
