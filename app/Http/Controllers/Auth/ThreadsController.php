<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Thread;
use App\Constants\Common;
use App\Helpers\Utils;
use App\Http\Controllers\Auth\AppController;

class ThreadsController extends AppController
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
    
    public function index(Request $request) {
        return view('auth.threads.index', $this->search($request, 'members'));
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
        
        $threads = Thread::where($wheres)->orderBy('created_at', 'DESC')->paginate(Common::ROW_PER_PAGE);
        
        $paging = $threads->toArray();
        
        if($request->ajax()) {
            $output['data'] = view('auth.threads.ajax_list', compact('threads', 'paging'))->render();
            return response()->json($output);
        } else {
            return compact('threads', 'paging');
        }
        
    }
}
