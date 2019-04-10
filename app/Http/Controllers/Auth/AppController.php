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
    public $output = ['data' => null, 'name' => '', 'rules' => [], 'editor' => 'editor.small.js'];
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
        $this->middleware(['auth', 'admin'])->except('showLoginForm', 'login');
        
        // Config
        $config = Utils::getConfig();
        
        if($config) {
            $web_logo = Utils::getImageLink($config->web_logo);
            $web_ico = Utils::getImageLink($config->web_ico);
            
            $this->config = [
                'config' => [
                    'web_logo' => $web_logo,
                    'web_ico' => $web_ico,
                    'mail_from' => Utils::cnvNull($config->mail_from, 'support@gmail.com'),
                    'mail_name' => Utils::cnvNull($config->mail_name, 'Mail System'),
                    'upload_banner_maximum_upload' => Utils::cnvNull($config->upload_banner_maximum_upload, 51200),
                    'upload_logo_maximum_upload' => Utils::cnvNull($config->upload_logo_maximum_upload, 51200),
                    'upload_image_maximum_upload' => Utils::cnvNull($config->upload_image_maximum_upload, 51200),
                    'upload_photo_maximum_upload'   => Utils::cnvNull($config->upload_photo_maximum_upload, 51200),
                    'upload_web_logo_maximum_upload'   => Utils::cnvNull($config->upload_web_logo_maximum_upload, 51200),
                    'upload_web_ico_maximum_upload'   => Utils::cnvNull($config->upload_web_ico_maximum_upload, 51200),
                    'upload_avatar_maximum_upload'   => Utils::cnvNull($config->upload_avatar_maximum_upload, 51200),
                    
                    'upload_banner_image_size' => Utils::cnvNull($config->upload_banner_image_size, '100x100'),
                    'upload_logo_image_size' => Utils::cnvNull($config->upload_logo_image_size, '100x100'),
                    'upload_image_image_size' => Utils::cnvNull($config->upload_image_image_size, '100x100'),
                    'upload_photo_image_size'   => Utils::cnvNull($config->upload_photo_image_size, '100x100'),
                    'upload_web_logo_image_size'   => Utils::cnvNull($config->upload_web_logo_image_size, '100x100'),
                    'upload_web_ico_image_size'   => Utils::cnvNull($config->upload_web_ico_image_size, '100x100'),
                    'upload_avatar_image_size'   => Utils::cnvNull($config->upload_avatar_image_size, '100x100'),
                    
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
        if($this->name == 'posts' || $this->name == 'products') {
            $this->output['editor'] = 'editor.full.js';
        }
        $this->rules = trans('auth.' . $this->name . '.rules');
        $this->rules = is_array($this->rules) ? $this->rules : [];
        $this->output['name'] =  $this->name;
        $this->output['rules'] = $this->rules;
    }
    
    public function doSearch($request, Model $model, $type = '', $view = 'auth.ajax_list') {
        
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
            
            if($type == 'members') {
                $wheres[] = ['role_id', '=', UserRole::MEMBERS];
            }
        }
        
        if($model instanceof Category) {
        }
        
        if($model instanceof Product) {
        }
        
        
        $data_list = $model::where($wheres)->orderBy('created_at', 'DESC')->paginate(Common::ROW_PER_PAGE);
        
        $paging = $data_list->toArray();
        
        if($request->ajax()) {
            $this->result['data'] = view($view, compact('data_list', 'paging', 'name'))->render();
            return response()->json($this->result);
        } else {
            return compact('data_list', 'paging', 'name');
        }
    }
    
}
