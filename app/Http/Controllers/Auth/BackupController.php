<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Backup;
use App\Helpers\BackupGenerate;

class BackupController extends AppController
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
        return view('auth.backup.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request) {
        return $this->doSearch($request, new Backup());
    }
    
    /**
     * create
     * @param Request $request
     */
    public function create(Request $request) {
        $backup = BackupGenerate::getInstance()->make();
    }
    
}
