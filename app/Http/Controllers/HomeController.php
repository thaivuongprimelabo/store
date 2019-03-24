<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Banner;
use App\Page;
use App\Product;
use App\Vendor;
use App\Constants\Common;
use App\Constants\ContactStatus;
use App\Constants\Status;
use App\Helpers\Utils;
use App\Category;
use App\Contact;

class HomeController extends AppController
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banners = Banner::where('status', Status::ACTIVE)->get();
        
        $showSidebar = 'show';
        
        return view('shop.home', compact('banners', 'showSidebar'));
    }
    
    public function vendor(Request $request) {
        $slug = str_replace($this->config['config']['url_ext'], '', $request->vendor);
        
        $vendor = Vendor::select('name')->where('name_url', $slug)->first();
        
        if($vendor) {
            $this->breadcrumb['active'] = $vendor->name;
        }
        
        $breadcrumb  = $this->breadcrumb;
        $showSidebar = 'hide';
        
        return view('shop.vendor', compact('breadcrumb', 'showSidebar'));
    }
    
    public function category(Request $request) {
        $slug = str_replace($this->config['config']['url_ext'], '', $request->slug);
        
        $category = Category::select('name')->where('name_url', $slug)->first();
        
        if($category) {
            $this->breadcrumb['active'] = $category->name;
        }
        
        $breadcrumb  = $this->breadcrumb;
        $showSidebar = 'hide';
        
        return view('shop.category', compact('breadcrumb', 'showSidebar'));
    }
    
    public function productDetails(Request $request) {
        $slug = $request->slug;
        $slug2 = $request->slug2;
        
        $products = Product::select(
                        'products.name',
                        'products.price',
                        'products.id',
                        'products.description',
                        'products.sizes',
                        'products.colors',
                        'products.category_id',
                        'products.is_new',
                        'products.is_best_selling',
                        'products.is_popular',
                        'products.discount',
                        'images_product.image'
                    )
                    ->leftJoin('images_product','images_product.product_id', '=', 'products.id')
                    ->where(['products.status' => Status::ACTIVE, 'products.name_url' => $slug2])->get();
        
        $category = Category::select('id', 'name')->where('name_url', $slug)->first();
        
        $another_products = Product::select(
                        'products.name',
                        'products.price',
                        'products.id',
                        'products.is_new',
                        'products.is_best_selling',
                        'products.is_popular',
                        'products.discount',
                        'categories.name_url AS category_name_url',
                        'products.name_url',
                        'images_product.image'
                    )
                    ->leftJoin('images_product','images_product.product_id', '=', 'products.id')
                    ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
                    ->where([
                        ['products.status', '=',  Status::ACTIVE],
                        ['products.category_id', '=', $category->id],
                        ['products.id', '!=', $products->first()->id]
                    ])
                    ->get();
            
            $this->breadcrumb[route('category',['slug' => $slug])] = $category->name;
            $this->breadcrumb['active'] = $products->first()->name;
            
            $breadcrumb  = $this->breadcrumb;
            $showSidebar = 'hide';
            
            return view('shop.product_detail', compact('products', 'breadcrumb', 'showSidebar', 'another_products'));
        
    }
    
    public function products(Request $request) {
        
        $this->breadcrumb['active'] = trans('shop.main_nav.products');
        
        $breadcrumb  = $this->breadcrumb;
        $showSidebar = 'hide';
                    
        return view('shop.products', compact('breadcrumb', 'showSidebar'));
    }
    
    public function about(Request $request) {
        $this->breadcrumb['active'] = trans('shop.main_nav.about');
        
        $breadcrumb  = $this->breadcrumb;
        $showSidebar = 'hide';
        
        $about = Page::find(1);
        return view('shop.about', compact('about', 'breadcrumb', 'showSidebar'));
    }
    
    public function delivery(Request $request) {

        $this->breadcrumb['active'] = trans('shop.main_nav.delivery');
        
        $breadcrumb  = $this->breadcrumb;
        $showSidebar = 'hide';
        
        $delivery = Page::find(2);
        return view('shop.delivery', compact('delivery', 'breadcrumb', 'showSidebar'));
    }
    
    public function contact(Request $request) {
        
        $this->breadcrumb['active'] = trans('shop.main_nav.contact');
        
        $breadcrumb  = $this->breadcrumb;
        $showSidebar = 'hide';
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'content' => 'required',
                'subject' => 'required',
                'captcha' => 'required'
            ]);
            
            if($request->getSession()->has('captcha')) {
                $rules['captcha'] = 'required|captcha';
            }
            
            if($validator->fails()) {
                return redirect(route('contact'))->with('error', trans('messages.ERROR'));
            }
            
            $contact = new Contact();
            
            $contact->name = Utils::cnvNull($request->name, '');
            $contact->email = Utils::cnvNull($request->email, '');
            $contact->phone = Utils::cnvNull($request->phone, '');
            $contact->content = Utils::cnvNull($request->content, '');
            $contact->subject = Utils::cnvNull($request->subject, '');
            $contact->status = ContactStatus::NEW_CONTACT;
            $contact->created_at    = date('Y-m-d H:i:s');
            $contact->updated_at    = date('Y-m-d H:i:s');
            
            if($contact->save()) {
                return redirect(route('contact'))->with('success', trans('messages.SEND_CONTACT_SUCCESS'));
            } else {
                return redirect(route('contact'))->with('error', trans('messages.ERROR'));
            }
        }
        return view('shop.contact', compact('breadcrumb', 'showSidebar'));
    }
    
    public function search(Request $request) {
        $keyword = $request->keyword;
        $category_id = $request->category_id;
        
        $title = str_replace('{0}', $keyword, trans('shop.search_result'));
        
        $this->breadcrumb['active'] = $title;
        
        $breadcrumb  = $this->breadcrumb;
        $showSidebar = 'hide';
        
        $conditions = [
            ['products.name', 'LIKE', '%' . $keyword . '%'],
            ['products.category_id', '=', $category_id]
        ];
        
        $products = $this->doSearch($conditions);
        
        return view('shop.search', compact('products', 'breadcrumb', 'showSidebar', 'title'));
    }
        
    private function doSearch($conditions = []) {
        $wheres = [
            ['products.status', '=', Status::ACTIVE]
        ];
        
        $wheres = array_merge($wheres, $conditions);
        
        $object = Product::select(
                    'products.name',
                    'products.price',
                    'products.id',
                    'categories.name_url AS category_name_url',
                    'products.name_url',
                    'products.is_new',
                    'products.is_best_selling',
                    'products.is_popular',
                    'products.discount',
                    DB::raw('GROUP_CONCAT(images_product.image) AS image')
                )
                ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
                ->leftJoin('images_product','images_product.product_id', '=', 'products.id')
                ->where($wheres)
                ->groupBy('products.id')->paginate(Common::LIMIT_PRODUCT_SHOW);
        
        return $object;
    }
    
    public function loadData(Request $request) {
        
        $result = [
            'code' => 404,
        ];
        
        if($request->ajax()) {
            $page = $request->page_name;
            
            switch($page) {
                case 'home-page':
                    $new_products          = $this->getProducts([['products.is_new', '=', Status::IS_NEW]])['products'];
                    $discount_products     = $this->getProducts([['products.discount', '>', 0]])['products'];
                    $best_selling_products = $this->getProducts([['products.is_best_selling', '=', Status::IS_BEST_SELLING]])['products'];
                    
                    $news = view('shop.common.product', ['title' => trans('shop.new_products'), 'data' => $new_products])->render();
                    $discount = view('shop.common.product',['title' => trans('shop.discount_products'), 'data' => $discount_products])->render();
                    $best_selling = view('shop.common.product',['title' => trans('shop.best_selling'), 'data' => $best_selling_products])->render();
                    
                    $result['code'] = 200;
                    $result['data'] = $news . $discount . $best_selling;
                    break;
                    
                case 'category-page':
                    $slug = $request->slug;
                    $products = $this->getProducts([['categories.name_url', '=', $slug]]);
                    $result['code'] = 200;
                    $result['data'] = view('shop.common.product',['title' => '', 'data' => $products['products']])->render();
                    $result['paging'] =  $products['paging'];
                    break;
                    
                case 'vendor-page':
                    $slug = $request->slug;
                    $products = $this->getProducts([['vendors.name_url', '=', $slug]]);
                    $result['code'] = 200;
                    $result['data'] = view('shop.common.product',['title' => '', 'data' => $products['products']])->render();
                    $result['paging'] =  $products['paging'];
                    break;
                    
                case 'product-page':
                    $sort = $request->sort;
                    $products = $this->getProducts([], $sort);
                    $result['code'] = 200;
                    $result['data'] = view('shop.common.product_ajax', ['data' => $products['products']])->render();
                    $result['paging'] =  $products['paging'];
                    
                    $discount_products     = $this->getProducts([['products.discount', '>', 0]], '', 5)['products'];
                    $best_selling_products = $this->getProducts([['products.is_best_selling', '=', Status::IS_BEST_SELLING]], '', 5)['products'];
                    
                    $result['widget'] = view('shop.common.widget',['title' => trans('shop.discount_products'), 'data' => $discount_products])->render() .
                                        view('shop.common.widget',['title' => trans('shop.best_selling'), 'data' => $best_selling_products])->render();
                    break;
            }
        }
        
        return response()->json($result);
    }
    
    private function getProducts($wheres = [], $sort = '', $limit = Common::LIMIT_PRODUCT_SHOW) {
        
        $column = 'products.id';
        $order = 'asc';
        
        if(!Utils::blank($sort)) {
            $arrSort = explode('_', $sort);
            if(count($arrSort)) {
                $column = $arrSort[0];
                $order = $arrSort[1];
            }
        }
        
        array_push($wheres, ['products.status', '=', Status::ACTIVE]);
        
        $products = Product::select(
                        'products.name',
                        'products.price',
                        'products.id',
                        'categories.name_url AS category_name_url',
                        'products.name_url',
                        'products.is_new',
                        'products.is_best_selling',
                        'products.is_popular',
                        'products.discount',
                        DB::raw('GROUP_CONCAT(images_product.image) AS image')
                  )
                  ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
                  ->leftJoin('vendors', 'vendors.id', '=', 'products.vendor_id')
                  ->leftJoin('images_product','images_product.product_id', '=', 'products.id')
                  ->where($wheres)
                  ->groupBy('products.id')
                  ->orderBy($column, $order)
                  ->paginate($limit);
        
        $paging = $products->links('shop.common.paging', ['paging' => $products->toArray()])->toHtml();
        
        return compact('products', 'paging');
    }
}
