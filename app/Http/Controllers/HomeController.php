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
        
        return view('shop.home', array_merge(compact('banners', 'showSidebar'), $this->loadProducts(false, true, true, true)));
    }
    
    public function vendor(Request $request) {
        $slug = str_replace($this->config['config']['url_ext'], '', $request->vendor);
        
        $products = Product::select(
                        'products.name', 
                        'products.price',
                        'products.id', 
                        'products.name_url',
                        'vendors.name_url AS vendor_name_url',
                        'products.is_new',
                        'products.is_best_selling',
                        'products.is_popular',
                        'products.discount',
                        DB::raw('GROUP_CONCAT(images_product.image) AS image')
                    )
                    ->leftJoin('vendors', 'vendors.id', '=', 'products.vendor_id')
                    ->leftJoin('images_product','images_product.product_id', '=', 'products.id')
                    ->where(['vendors.name_url' => $slug])
                    ->groupBy('products.id')->get();
        
        $vendor = Vendor::select('name')->where('name_url', $slug)->first();
        
        if($vendor) {
            $this->breadcrumb['active'] = $vendor->name;
        }
        
        $breadcrumb  = $this->breadcrumb;
        $showSidebar = 'hide';
        
        return view('shop.vendor', compact('products', 'breadcrumb', 'showSidebar'));
    }
    
    public function category(Request $request) {
        $slug = str_replace($this->config['config']['url_ext'], '', $request->slug);
        
        $products = Product::select(
                        'products.name',
                        'products.price',
                        'products.id',
                        'products.name_url',
                        'categories.name_url AS category_name_url',
                        'products.is_new',
                        'products.is_best_selling',
                        'products.is_popular',
                        'products.discount',
                        DB::raw('GROUP_CONCAT(images_product.image) AS image')
                    )
                    ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
                    ->leftJoin('images_product','images_product.product_id', '=', 'products.id')
                    ->where(['categories.name_url' => $slug])
                    ->groupBy('products.id')->get();
                    
            $category = Category::select('name')->where('name_url', $slug)->first();
            
            if($category) {
                $this->breadcrumb['active'] = $category->name;
            }
            
            $breadcrumb  = $this->breadcrumb;
            $showSidebar = 'hide';
            
            return view('shop.category', compact('products', 'breadcrumb', 'showSidebar'));
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
                        'products.name_url'
                    )
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
        
        if($request->ajax()) {
            $sort = $request->sort;
            $data = $this->loadProducts(true, false, false, false, $sort);

            $output = [];
            $output['code'] = 200;
            $output['paging'] = $data['paging'];
            $output['data'] = view('shop.common.product_ajax', $data)->render();
            
            return response()->json($output);
            exit;
        }
                    
        $this->breadcrumb['active'] = trans('shop.main_nav.products');
        
        $breadcrumb  = $this->breadcrumb;
        $showSidebar = 'hide';
                    
        return view('shop.products', array_merge(compact('breadcrumb', 'showSidebar'), $this->loadProducts(false, false, true, false)));
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
            ]);
            
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
    
    private function loadProducts($all = false, $is_new = false, $is_best_selling = false, $discount = false, $sort = '', $limit = Common::LIMIT_PRODUCT_SHOW) {
        $output = [];
        
        $wheres = [
            'products.status' => Status::ACTIVE
        ];
        
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
                    ->groupBy('products.id');
        
        if($all) {
            $conditions = $wheres;
            if(!Utils::blank($sort)) {
                $arrSort = explode('_', $sort);
                $products = $object->where($conditions)->orderBy($arrSort[0], $arrSort[1])->paginate($limit);
            } else {
                $products = $object->where($conditions)->orderBy('products.created_at', 'desc')->paginate($limit);
            }
            $output['products'] = $products;
            $output['paging']   = $products->links('shop.common.paging', ['paging' => $products->toArray()])->toHtml();
        }
            
        if($is_new) {
            $conditions = $wheres;
            $conditions['is_new'] = Status::IS_NEW;
            $new_products  = $object->where($conditions)->orderBy('products.created_at', 'desc')->paginate($limit);
            $output['new_products'] = $new_products;
        }
        
        if($is_best_selling) {
            $conditions = $wheres;
            $conditions['is_best_selling'] = Status::IS_BEST_SELLING;
            $best_selling_products  = $object->where($conditions)->orderBy('products.created_at', 'desc')->paginate($limit);
            $output['best_selling_products'] = $best_selling_products;
        }
        
        if($discount) {
            $conditions = $wheres;
            $conditions[] = ['discount', '>', 0];
            $discount_products  = $object->where($conditions)->orderBy('products.created_at', 'desc')->paginate($limit);
            $output['discount_products'] = $discount_products;
        }
        
        return $output;
    }
}
