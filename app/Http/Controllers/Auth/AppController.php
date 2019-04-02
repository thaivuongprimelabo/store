<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Common;
use App\Constants\UserRole;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\User;
use App\Category;
use App\Product;
class AppController extends Controller
{
    public $config = [];
    public $result = ['code' => 200, 'data' => ''];
    public $name = '';
    public $rules = [];
    public $output = ['data' => null, 'name' => '', 'rules' => []];
    
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('showLoginForm', 'login');
        
        // Config
        $config = Utils::getConfig();
        
        if($config) {
            $web_logo = Utils::getImageLink($config->web_logo);
            $web_ico = Utils::getImageLink($config->web_ico);
            
            $this->config = [
                'config' => [
                    'web_logo' => $web_logo,
                    'web_ico' => $web_ico,
                    'banners_maximum_upload' => Utils::cnvNull($config->banners_maximum_upload, 51200),
                    'vendors_maximum_upload' => Utils::cnvNull($config->vendors_maximum_upload, 51200),
                    'products_maximum_upload' => Utils::cnvNull($config->products_maximum_upload, 51200),
                    'posts_maximum_upload'   => Utils::cnvNull($config->post_maximum_upload, 51200),
                    'web_logo_maximum_upload'   => Utils::cnvNull($config->web_logo_maximum_upload, 51200),
                    'web_ico_maximum_upload'   => Utils::cnvNull($config->web_ico_maximum_upload, 51200),
                    'users_maximum_upload'   => Utils::cnvNull($config->users_maximum_upload, 51200),
                    'avatar_maximum_upload'   => Utils::cnvNull($config->users_maximum_upload, 51200),
                    'attachment_maximum_upload'   => Utils::cnvNull($config->attachment_maximum_upload, 51200),
                    
                    'banners_image_size' => Utils::cnvNull($config->banners_image_size, '100x100'),
                    'vendors_image_size' => Utils::cnvNull($config->vendors_image_size, '100x100'),
                    'products_image_size' => Utils::cnvNull($config->products_image_size, '100x100'),
                    'posts_image_size'   => Utils::cnvNull($config->posts_image_size, '100x100'),
                    'web_logo_image_size'   => Utils::cnvNull($config->web_logo_image_size, '100x100'),
                    'web_ico_image_size'   => Utils::cnvNull($config->web_ico_image_size, '100x100'),
                    'users_image_size'   => Utils::cnvNull($config->users_image_size, '100x100'),
                    'avatar_image_size' => Utils::cnvNull($config->users_image_size, '100x100'),
                    
                    'url_ext' => Utils::cnvNull($config->url_ext, '.html'),
                ]
            ];
            View::share($this->config);
        }
        
        $arrUnaccess = [
            'users'
        ];
        
        $exp = explode('_', Route::currentRouteName());
        $this->name = isset($exp[1]) ? $exp[1] : '';
        $this->rules = trans('auth.' . $this->name . '.rules');
        $this->output['name'] =  $this->name;
        $this->output['rules'] = $this->rules;
    }
    
    public function doSearch($request, Model $model, $type = '') {
        
        $wheres = [];
        $route = Route::currentRouteName();
        $name = str_replace('auth_', '', str_replace('_search', '', Route::currentRouteName()));
        
        if($request->isMethod('post')) {
            
            $data = $request->all();
            $search_condition = trans('auth.' . $name . '.search_form');
            
            foreach($search_condition as $key=>$con) {
                $value = $data[$key];
                if(!Utils::blank($value)) {
                    if($key == 'name') {
                        $wheres[] = [$key, 'LIKE', '%' . $value . '%'];
                    } else {
                        $wheres[] = [$key, '=', $value];
                    }
                }
            }
        }
        
        if($model instanceof User) {
            switch(Auth::user()->role_id) {
                case UserRole::SUPER_ADMIN:
                case UserRole::ADMIN:
                    $wheres[] = ['role_id', '!=', UserRole::SUPER_ADMIN];
                    break;
            }
        }
        
        if($model instanceof Category) {
        }
        
        if($model instanceof Product) {
        }
        
        
        $data_list = $model::where($wheres)->orderBy('created_at', 'DESC')->paginate(Common::ROW_PER_PAGE);
        
        $paging = $data_list->toArray();
        
        if($request->ajax()) {
            $this->result['data'] = view('auth.ajax_list', compact('data_list', 'paging', 'name'))->render();
            return response()->json($this->result);
        } else {
            return compact('data_list', 'paging', 'name');
        }
    }
}
