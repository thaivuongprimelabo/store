<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Product;
use App\Constants\Status;

class HomeController extends AppController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $a = 1 % 3;
        $banners = Banner::where('status', Status::ACTIVE)->get();
        $new_products           = Product::where(['status' => Status::ACTIVE, 'is_new' => Status::IS_NEW])->paginate(6);
        $poplar_products        = Product::where(['status' => Status::ACTIVE, 'is_popular' => Status::IS_POPULAR])->paginate(3);
        $best_selling_products  = Product::where(['status' => Status::ACTIVE, 'is_best_selling' => Status::IS_BEST_SELLING])->paginate(3);
        return view('shop.home', compact('banners', 'new_products', 'poplar_products', 'best_selling_products'));
    }
    
    public function category(Request $request) {
        $slug = str_replace($this->config['config']['url_ext'], '', $request->slug);
        
        $products = Product::select('products.name', 'products.price', 'products.id', 'categories.name AS category_name')->join('categories', 'categories.id', '=', 'products.category_id')
                    ->where(['categories.name_url' => $slug, 'products.status' => Status::ACTIVE])->get();
        
        
        return view('shop.category', compact('products'));
    }
}
