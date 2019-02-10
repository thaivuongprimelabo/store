<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends AppController
{
    public $breadcrumb = [];
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->breadcrumb = [route('home') => trans('shop.home')];
    }
    
    public function index(Request $request) {

        if(!$request->session()->exists('cart')) {
            return redirect(route('home'));
        }

        $this->breadcrumb['active'] = trans('shop.cart.title');

        $breadcrumb  = $this->breadcrumb;
        $showSidebar = 'hide';

        return view('shop.cart', compact('breadcrumb', 'showSidebar'));
    }
}
