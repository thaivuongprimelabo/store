<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Slots;

class BookingController extends AppController
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
        return view('auth.booking.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request) {
        return $this->doSearch($request, new Slots());
    }
    
    /**
     * create
     * @param Request $request
     */
    public function create(Request $request) {
        
    }
    
    /**
     * edit
     * @param Request $request
     */
    public function edit(Request $request) {
        
    }
    
    public function remove(Request $request) {
    }
}
