<?php

namespace App\Http\Controllers\Auth;

use App\Vendor;
use App\Constants\Common;
use App\Constants\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Utils;
use App\Customer;
use App\Thread;

class ForumController extends AppController
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
        
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request, $type) {
        $wheres = [];
        $output = ['code' => 200, 'data' => ''];
        
        switch($type) {
            case 'members':
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
                    
                    $email_search = $request->email_search;
                    if(!Utils::blank($status_search)) {
                        $wheres[] = ['email', '=', $email_search];
                    }
                }
                
                $members = Customer::where($wheres)->orderBy('created_at', 'DESC')->paginate(Common::ROW_PER_PAGE);
                
                $paging = $members->toArray();
                
                if($request->ajax()) {
                    $output['data'] = view('auth.forum.members.ajax_list', compact('members', 'paging'))->render();
                    return response()->json($output);
                } else {
                    return compact('members', 'paging');
                }
                break;
                
            case 'threads' :
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
                    
                    $email_search = $request->email_search;
                    if(!Utils::blank($status_search)) {
                        $wheres[] = ['email', '=', $email_search];
                    }
                }
                
                $threads = Thread::where($wheres)->orderBy('created_at', 'DESC')->paginate(Common::ROW_PER_PAGE);
                
                $paging = $threads->toArray();
                
                if($request->ajax()) {
                    $output['data'] = view('auth.forum.threads.ajax_list', compact('threads', 'paging'))->render();
                    return response()->json($output);
                } else {
                    return compact('threads', 'paging');
                }
                break;
        }
        
    }
    
    public function members(Request $request) {
        return view('auth.forum.members.index', $this->search($request, 'members'));
    }
    
    public function threads(Request $request) {
        return view('auth.forum.threads.index', $this->search($request, 'threads'));
    }
}
