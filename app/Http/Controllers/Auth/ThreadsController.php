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
        return view('auth.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request) {
        return $this->doSearch($request, new Thread());
        
    }
}
