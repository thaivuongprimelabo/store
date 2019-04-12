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
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;

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
        
        $categories = Category::select('id', 'name', 'name_url', 'parent_id')->where('status', Status::ACTIVE)->where('parent_id', 0)->get();
        
        $posts = Post::where('status', PostStatus::PUBLISHED)->get();
        
        $this->output['banners'] = $banners;
        $this->output['categories'] = $categories;
        $this->output['posts'] = $posts;
        
        $this->setSEO([
            'title' => trans('shop.main_nav.home.text'),
            'summary' => $this->output['config']['web_description'],
            'keywords' => [$this->output['config']['web_name']],
            'link' => route('home'),
            'type' => 'website',
            'image' => url($this->output['config']['web_banner'])
        ]);
        
//         $this->setSEO([
//             'title' => $product->name,
//             'summary' => $product->getSEODescription(),
//             'section' => $product->getCategoryName(),
//             'keywords' => [$product->getSEOKeywords(), $product->getCategoryName(), $this->output['config']['web_name']],
//             'link' => $product->getLink(),
//             'type' => 'product',
//             'image' => $product->getFirstImage()
//         ]);
        
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
        
        $this->setSEO(['title' => $vendor->getName(), 'link' => $vendor->getLink()]);
        
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
        
        $this->setSEO(['title' => $category->getName(), 'link' => $category->getLink()]);
        
        return view('shop.product_list', $this->output);
    }
    
    public function productDetails(Request $request) {
        $slug = $request->slug;
        
        $product = Product::select(
                        'products.name',
                        'products.name_url',
                        'products.price',
                        'products.id',
                        'products.description',
                        'products.summary',
                        'products.category_id',
                        'products.is_new',
                        'products.is_best_selling',
                        'products.is_popular',
                        'products.discount',
                        'products.status',
                        'products.seo_keywords',
                        'products.seo_description'
                    )
                    ->where(['products.status' => Status::ACTIVE, 'products.name_url' => $slug])->first();
        
        $this->setSEO([
            'title' => $product->name,
            'summary' => $product->getSEODescription(),
            'section' => $product->getCategoryName(),
            'keywords' => [$product->getSEOKeywords(), $product->getCategoryName(), $this->output['config']['web_name']],
            'link' => $product->getLink(),
            'type' => 'product',
            'image' => $product->getFirstImage()
        ]);
        
        if(!$product) {
            return redirect('/');
        }
        
        $this->output['breadcrumbs'] = [
            ['link' => $product->getCategoryLink(), 'text' => $product->getCategoryName()],
            ['link' => '#', 'text' => $product->getName()]
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
        $this->setSEO(['title' => trans('shop.new_product_txt')]);
        return view('shop.product_list', $this->output);
    }
    
    public function popularProducts(Request $request) {
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.popular_txt')]
        ];
        
        $this->output['view_type'] = 'grid';
        $this->output['page_name'] = 'popular-products-page';
        $this->setSEO(['title' => trans('shop.popular_txt')]);
        return view('shop.product_list', $this->output);
    }
    
    public function bestSellProducts(Request $request) {
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.best_selling_txt')]
        ];
        
        $this->output['view_type'] = 'grid';
        $this->output['page_name'] = 'best-selling-products-page';
        $this->setSEO(['title' => trans('shop.best_selling_txt')]);
        return view('shop.product_list', $this->output);
        
    }
    
    public function products(Request $request) {
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.products_txt')]
        ];
        
        $this->output['view_type'] = 'grid';
        $this->output['page_name'] = 'all-products-page';
        
        $this->setSEO(['title' => trans('shop.main_nav.products.text'), 'link' => route('products')]);
        
        return view('shop.product_list', $this->output);
    }
    
    public function about(Request $request) {
        
        $about = Page::find(1);
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.main_nav.about.text')]
        ];
        $this->output['about'] = $about;
        
        $this->setSEO(['title' => trans('shop.main_nav.about.text'), 'link' => route('about')]);
        
        return view('shop.about', $this->output);
    }
    
    public function contact(Request $request) {
        
        
        if($request->ajax()) {
            
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'content' => 'required',
                'subject' => 'required',
            ];
            
            if($request->getSession()->has('captcha')) {
                $rules['captcha'] = 'required|captcha';
            }
            
            $messages = [
                'name.required' => trans('validation.required', ['attribute' => 'Họ tên']),
                'email.required' => trans('validation.required', ['attribute' => 'E-mail']),
                'phone.required' => trans('validation.required', ['attribute' => 'Số điện thoại']),
                'subject.required' => trans('validation.required', ['attribute' => 'Tựa đề']),
                'content.required' => trans('validation.required', ['attribute' => 'Nội dung']),
                'email.email' => trans('validation.email'),
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
            
            if($validator->fails()) {
                $errors = $validator->errors();
                $result['#contact_error'] = $this->createErrorList($errors->toArray());
                return response()->json($result);
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
                $result['#contact_success'] = trans('messages.SEND_CONTACT_SUCCESS');
            } else {
                $result['#contact_error'] = trans('messages.ERROR');
            }
            return response()->json($result);
        }
        
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.main_nav.contact.text')]
        ];
        
        $this->setSEO(['title' => trans('shop.main_nav.contact.text'), 'link' => route('contact')]);
        
        return view('shop.contact', $this->output);
    }
    
    public function search(Request $request) {
        
        $keyword = $request->q;
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.search_results', compact('keyword'))]
        ];
        
        $this->setSEO(['title' => trans('shop.search_results')]);
        
        return view('shop.search', $this->output);
    }
    
    public function posts(Request $request) {
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.main_nav.posts.text')]
        ];
        
        $this->output['title'] = trans('shop.main_nav.posts.text');
        $this->output['page_name'] = 'posts-page';
        
        $this->setSEO(['title' => trans('shop.main_nav.posts.text'), 'link' => route('posts')]);
        
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
        
        $this->setSEO([
            'title' => $post->name,
            'summary' => $post->getSEODescription(),
            'section' => $postGroup->getName(),
            'keywords' => [$post->getSEOKeywords(), $postGroup->getName(), $this->output['config']['web_name']],
            'link' => $post->getLink(),
            'type' => 'article',
            'image' => $post->getImage()
        ]);
            
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
        
        $this->setSEO(['title' => $postGroup->getName(), 'link' => $postGroup->getLink()]);
        
        return view('shop.posts', $this->output);
    }
    
    public function booking(Request $request) {
        
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.main_nav.booking.text')]
        ];
        
        return view('shop.booking', $this->output);
    }
    
    public function loadData(Request $request) {
        
        $result = [];
        
        if($request->ajax()) {
            $id = $request->id;
            $view_type = $request->view_type;
            $page = $request->page_name;
            $sort_by = $request->sort_by;
            $price_search = $request->price_search;
            $orderBy = 'products.created_at DESC';
            $keyword = $request->keyword;
            
            if(!Utils::blank($sort_by)) {
                $sort = explode(',', $sort_by);
                $orderBy = $sort[0] . ' ' . $sort[1];
            }
            
            $wherePriceSearch = '1 = 1';
            if(!Utils::blank($price_search)) {
                $wherePriceSearch .= ' AND (' . $price_search . ')';
            }
            
            $view = 'shop.common.product_ajax';
            $count = 0;
            switch($page) {
                    
                case 'category-page':
                    $whereIn = 'category_id = ' . $id;
                    $data = Product::active()->whereRaw($whereIn)->whereRaw($wherePriceSearch)->orderByRaw($orderBy)->paginate(Common::LIMIT_PRODUCT_SHOW);
                    break;
                    
                case 'new-products-page':
                    $data = Product::active()->isNew()->whereRaw($wherePriceSearch)->orderByRaw($orderBy)->paginate(Common::LIMIT_PRODUCT_SHOW);
                    break;
                    
                case 'popular-products-page':
                    $data = Product::active()->isPopular()->whereRaw($wherePriceSearch)->orderByRaw($orderBy)->paginate(Common::LIMIT_PRODUCT_SHOW);
                    break;
                    
                case 'best-selling-products-page':
                    $data = Product::active()->isBestSelling()->whereRaw($wherePriceSearch)->orderByRaw($orderBy)->paginate(Common::LIMIT_PRODUCT_SHOW);
                    break;
                    
                case 'all-products-page':
                    $data = Product::active()->orderByRaw($orderBy)->whereRaw($wherePriceSearch)->paginate(Common::LIMIT_PRODUCT_SHOW);
                    break;
                
                case 'vendor-page':
                    $data = Product::active()->where('vendor_id', $id)->whereRaw($wherePriceSearch)->paginate(Common::LIMIT_PRODUCT_SHOW);
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
                    $data = Product::active()->where('name', 'LIKE', '%' . $keyword . '%')->paginate(Common::LIMIT_POST_SHOW);
                    $view = 'shop.common.search_suggestion';
                    $result['#product_results'] = view($view, compact('data'))->render();
                    return response()->json($result);
                case 'search-page':
                    $obj = Product::active()->where('name', 'LIKE', '%' . $keyword . '%');
                    $count = $obj->count();
                    $data = $obj->paginate(Common::LIMIT_POST_SHOW);
                    $result['#result_count'] = $count;
                    break;
            }
        }
        
        $paging = $data->toArray();
        $result['#ajax_list'] = view($view, compact('data', 'view_type'))->render();
        $result['#ajax_paging'] =  $data->links('shop.common.paging', compact('paging'))->toHtml();
        
        return response()->json($result);
    }
    
}
