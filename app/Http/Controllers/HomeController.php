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
use App\PostGroups;
use App\Post;
use App\Constants\PostStatus;

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
        
        $categories = Category::select('id', 'name', 'name_url')->where('status', Status::ACTIVE)->where('parent_id', 0)->get();
        
        $posts = Post::where('status', PostStatus::PUBLISHED)->get();
        
        $this->output['banners'] = $banners;
        $this->output['categories'] = $categories;
        $this->output['posts'] = $posts;
        return view('shop.home', $this->output);
    }
    
    public function vendor(Request $request) {
        
        $vendor = Vendor::select('id', 'name')->active()->where('name_url', $request->slug)->first();
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => $vendor->getName()]
        ];
        $this->output['data'] = $vendor;
        $this->output['view_type'] = 'grid';
        $this->output['page_name'] = 'vendor-page';
        return view('shop.product_list', $this->output);
    }
    
    public function category(Request $request) {
        $category = Category::select('id', 'name')->active()->where('name_url', $request->slug)->first();
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => $category->getName()]
        ];
        $this->output['data'] = $category;
        $this->output['view_type'] = 'grid';
        $this->output['page_name'] = 'category-page';
        return view('shop.product_list', $this->output);
    }
    
    public function productDetails(Request $request) {
        $slug = $request->slug;
        
        $product = Product::select(
                        'products.name',
                        'products.price',
                        'products.id',
                        'products.description',
                        'products.summary',
                        'products.category_id',
                        'products.is_new',
                        'products.is_best_selling',
                        'products.is_popular',
                        'products.discount'
                    )
                    ->where(['products.status' => Status::ACTIVE, 'products.name_url' => $slug])->first();
        
        $this->output['breadcrumbs'] = [
            ['link' => $product->getCategoryLink(), 'text' => $product->getCategoryName()],
            ['link' => '#', 'text' => trans('shop.main_nav.about.text')]
        ];
        $this->output['data'] = $product;
        return view('shop.product_detail', $this->output);
        
    }
    
    public function newProducts(Request $request) {
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.new_product_txt')]
        ];
        
        $this->output['view_type'] = 'grid';
        $this->output['page_name'] = 'new-products-page';
        return view('shop.product_list', $this->output);
    }
    
    public function popularProducts(Request $request) {
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.popular_txt')]
        ];
        
        $this->output['view_type'] = 'grid';
        $this->output['page_name'] = 'popular-products-page';
        return view('shop.product_list', $this->output);
    }
    
    public function bestSellProducts(Request $request) {
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.best_selling_txt')]
        ];
        
        $this->output['view_type'] = 'grid';
        $this->output['page_name'] = 'best-selling-products-page';
        return view('shop.product_list', $this->output);
        
    }
    
    public function products(Request $request) {
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.products_txt')]
        ];
        
        $this->output['view_type'] = 'grid';
        $this->output['page_name'] = 'all-products-page';
        return view('shop.product_list', $this->output);
    }
    
    public function about(Request $request) {
        
        $about = Page::find(1);
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.main_nav.about.text')]
        ];
        $this->output['about'] = $about;
        return view('shop.about', $this->output);
    }
    
    public function contact(Request $request) {
        
        
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
        
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.main_nav.contact.text')]
        ];
        
        return view('shop.contact', $this->output);
    }
    
    public function search(Request $request) {
        
        $keyword = $request->q;
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.search_results', compact('keyword'))]
        ];
        
        return view('shop.search', $this->output);
    }
    
    public function posts(Request $request) {
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.main_nav.posts.text')]
        ];
        
        $this->output['title'] = trans('shop.main_nav.posts.text');
        $this->output['page_name'] = 'posts-page';
        
        return view('shop.posts', $this->output);
    }
    
    public function postDetails(Request $request) {
        
        $slug = $request->slug;
        $slug1 = $request->slug1;
        
        $postGroup = PostGroups::select('id', 'name')->active()->where('name_url', $slug)->first();
        $post = Post::active()->where('name_url', $slug1)->first();
        
        $this->output['breadcrumbs'] = [
            ['link' => route('posts'), 'text' => trans('shop.main_nav.posts.text')],
            ['link' => '#', 'text' => $postGroup->getName()],
        ];
        
        $this->output['page_name'] = 'post-details-page';
        $this->output['data'] = $post;
            
        return view('shop.post_details', $this->output);
    }
    
    public function postGroup(Request $request) {
        
        $slug = $request->slug;
        $postGroup = PostGroups::select('id', 'name')->active()->where('name_url', $slug)->first();
        
        $this->output['breadcrumbs'] = [
            ['link' => route('posts'), 'text' => trans('shop.main_nav.posts.text')],
            ['link' => '#', 'text' => $postGroup->getName()],
        ];
        
        $this->output['title'] = $postGroup->getName();
        $this->output['data'] = $postGroup;
        $this->output['page_name'] = 'posts-group-page';
        
        return view('shop.posts', $this->output);
    }
    
    public function loadData(Request $request) {
        
        $result = [
            'code' => 404,
        ];
        
        if($request->ajax()) {
            $id = $request->id;
            $view_type = $request->view_type;
            $page = $request->page_name;
            $sort_by = $request->sort_by;
            $price_search = $request->price_search;
            $orderBy = 'products.id ASC';
            $keyword = $request->keyword;
            
            if(!Utils::blank($sort_by)) {
                $sort = explode(',', $sort_by);
                $orderBy = $sort[0] . ' ' . $sort[1];
            }
            
            if(!Utils::blank($price_search)) {
                $whereIn .= ' AND ' . $price_search;
            }
            
            $view = 'shop.common.product_ajax';
            $count = 0;
            switch($page) {
                    
                case 'category-page':
                    $whereIn = 'category_id IN (SELECT id FROM categories WHERE parent_id = ' . $id . ' OR id = ' . $id . ')';
                    $data = Product::active()->whereRaw($whereIn)->orderByRaw($orderBy)->paginate(Common::LIMIT_PRODUCT_SHOW);
                    break;
                    
                case 'new-products-page':
                    $data = Product::active()->isNew()->orderByRaw($orderBy)->paginate(Common::LIMIT_PRODUCT_SHOW);
                    break;
                    
                case 'popular-products-page':
                    $data = Product::active()->isPopular()->orderByRaw($orderBy)->paginate(Common::LIMIT_PRODUCT_SHOW);
                    break;
                    
                case 'best-selling-products-page':
                    $data = Product::active()->isBestSelling()->orderByRaw($orderBy)->paginate(Common::LIMIT_PRODUCT_SHOW);
                    break;
                    
                case 'all-products-page':
                    $data = Product::active()->orderByRaw($orderBy)->paginate(Common::LIMIT_PRODUCT_SHOW);
                    break;
                
                case 'vendor-page':
                    $data = Product::active()->where('vendor_id', $id)->paginate(Common::LIMIT_PRODUCT_SHOW);
                    break;
                
                case 'posts-page':
                    $data = Post::active()->paginate(Common::LIMIT_POST_SHOW);
                    $view = 'shop.common.post_ajax';
                    break;
                    
                case 'posts-group-page':
                    $data = Post::active()->where('post_group_id', $id)->paginate(Common::LIMIT_POST_SHOW);
                    $view = 'shop.common.post_ajax';
                    break;
                    
                case 'search-suggestion-page':
                    $obj = Product::active()->where('name', 'LIKE', '%' . $keyword . '%')->paginate(Common::LIMIT_POST_SHOW);
                    $view = 'shop.common.search_suggestion';
                case 'search-page':
                    $obj = Product::active()->where('name', 'LIKE', '%' . $keyword . '%');
                    $count = $obj->count();
                    $data = $obj->paginate(Common::LIMIT_POST_SHOW);
                    break;
            }
        }
        
        $paging = $data->toArray();
        $result['code'] = 200;
        $result['data'] = view($view, compact('data', 'view_type'))->render();
        $result['paging'] =  $data->links('shop.common.paging', compact('paging'))->toHtml();
        $result['count'] = $count;
        
        return response()->json($result);
    }
    
}
