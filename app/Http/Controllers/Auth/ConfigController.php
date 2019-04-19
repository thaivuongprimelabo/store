<?php

namespace App\Http\Controllers\Auth;

use App\Config;
use App\Constants\Common;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class ConfigController extends AppController
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Request $request) {
        $data = Config::first();
        if($request->isMethod('post')) {
            
            if($request->clear_config_cache) {
                Artisan::call('config:clear');
                Artisan::call('view:clear');
                echo '=============== Clear view cache =============== ';
                exit;
            }
            if($request->clear_data) {
                
                $uploadFolder = Common::UPLOAD_FOLDER;
                // Remove avatar
                $dirPath = $uploadFolder . Common::AVATAR_FOLDER;
                if(!Utils::deleteDir($dirPath)) {
                    echo '=============== error=============== ';
                    exit;
                }
                
                // Remove banner
                $dirPath = $uploadFolder . Common::BANNER_FOLDER;
                if(!Utils::deleteDir($dirPath)) {
                    echo '=============== error=============== ';
                    exit;
                }
                
                // Remove ico
                $dirPath = $uploadFolder . Common::ICO_FOLDER;
                if(!Utils::deleteDir($dirPath)) {
                    echo '=============== error=============== ';
                    exit;
                }
                
                // Remove image
                $dirPath = $uploadFolder . Common::IMAGE_FOLDER;
                if(!Utils::deleteDir($dirPath)) {
                    echo '=============== error=============== ';
                    exit;
                }
                
                // Remove vendor logo
                $dirPath = $uploadFolder . Common::VENDOR_FOLDER;
                if(!Utils::deleteDir($dirPath)) {
                    echo '=============== error=============== ';
                    exit;
                }
                
                // Remove vendor logo
                $dirPath = $uploadFolder . Common::WEBLOGO_FOLDER;
                if(!Utils::deleteDir($dirPath)) {
                    echo '=============== error=============== ';
                    exit;
                }
                
                DB::beginTransaction();
                try {
                    DB::table('categories')->truncate();
                    DB::table('vendors')->truncate();
                    DB::table('products')->truncate();
                    DB::table('images_product')->truncate();
                    DB::table('product_details')->truncate();
                    DB::table('product_detail_groups')->truncate();
                    DB::table('posts')->truncate();
                    DB::table('banners')->truncate();
                    DB::table('orders')->truncate();
                    DB::table('order_details')->truncate();
                    DB::table('contacts')->truncate();
                    DB::table('users')->truncate();
                    
                    DB::query('ALTER TABLE categories AUTO_INCREMENT = 1');
                    DB::query('ALTER TABLE vendors AUTO_INCREMENT = 1');
                    DB::query('ALTER TABLE products AUTO_INCREMENT = 1');
                    DB::query('ALTER TABLE posts AUTO_INCREMENT = 1');
                    DB::query('ALTER TABLE banners AUTO_INCREMENT = 1');
                    DB::query('ALTER TABLE orders AUTO_INCREMENT = 1');
                    DB::query('ALTER TABLE order_details AUTO_INCREMENT = 1');
                    DB::query('ALTER TABLE contacts AUTO_INCREMENT = 1');
                    DB::query('ALTER TABLE images_product AUTO_INCREMENT = 1');
                    DB::query('ALTER TABLE product_details AUTO_INCREMENT = 1');
                    DB::query('ALTER TABLE product_detail_groups AUTO_INCREMENT = 1');
                    DB::query('ALTER TABLE users AUTO_INCREMENT = 1');
                    
                    $users = [
                        ['id' => 1, 'name' => 'Super Administrator',
                            'email' => 'super.admin@admin.com',
                            'password' => Hash::make('!23456Abc'),
                            'role_id' => Common::SUPER_ADMIN,
                            'status' => 1,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                        ['id' => 2, 'name' => 'Administrator',
                            'email' => 'admin@admin.com',
                            'password' => Hash::make('!23456Abc'),
                            'role_id' => Common::ADMIN,
                            'status' => 1,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]
                    ];
                    DB::table(Common::USERS)->delete();
                    DB::table(Common::USERS)->insert($users);
                    
                    $config = [
                        [
                            'id' => 1
                        ]
                    ];
                    DB::table(Common::CONFIG)->delete();
                    DB::table(Common::CONFIG)->insert($config);
                    
                    DB::commit();
                } catch(\Exception $e) {
                    DB::rollback();
                    echo '=============== ' . $e->getMessage() . ' =============== ';
                    exit;
                }
                echo '=============== Done! =============== ';
                exit;
            }
            $web_ico = $data->web_ico;
            $web_logo = $data->web_logo;
            $web_banner = $data->web_banner;
            Utils::doUploadSimple($request, 'upload_web_logo', $web_logo);
            Utils::doUploadSimple($request, 'upload_web_ico', $web_ico);
            Utils::doUploadSimple($request, 'upload_web_banner', $web_banner);
            $data->web_title       = Utils::cnvNull($request->web_title, '');
            $data->web_description = Utils::cnvNull($request->web_description, '');
            $data->web_keywords    = Utils::cnvNull($request->web_keywords, '');
            $data->web_logo        = $web_logo;
            $data->web_ico         = $web_ico;
            $data->web_banner      = $web_banner;
            $data->web_email       = Utils::cnvNull($request->web_email, '');
            $data->url_ext         = Utils::cnvNull($request->url_ext, '');
            
            $web_address = $request->web_address;
            if(is_array($web_address) && count($web_address)) {
                $web_address = array_filter($web_address, 'strlen');
                $web_address = implode('|', $web_address);
                $data->web_address = $web_address;
            }
            
            $data->web_email = Utils::cnvNull($request->web_email, '');
            
            $web_hotline = $request->web_hotline;
            if(is_array($web_hotline) && count($web_hotline)) {
                $web_hotline = array_filter($web_hotline, 'strlen');
                $web_hotline = implode('|', $web_hotline);
                $data->web_hotline = $web_hotline;
            }
            
            $web_hotline_cskh = $request->web_hotline_cskh;
            if(is_array($web_hotline_cskh) && count($web_hotline_cskh)) {
                $web_hotline_cskh = array_filter($web_hotline_cskh, 'strlen');
                $web_hotline_cskh = implode('|', $web_hotline_cskh);
                $data->web_hotline_cskh = $web_hotline_cskh;
            }
            
            $data->web_working_time = Utils::cnvNull($request->web_working_time, '');
            $data->freeship = Utils::cnvNull($request->freeship, '');
            $data->footer_text = Utils::cnvNull($request->footer_text, '');
            $data->facebook_fanpage = Utils::cnvNull($request->facebook_fanpage, '');
            $data->youtube_channel = Utils::cnvNull($request->youtube_channel, '');
            $data->zalo_page = Utils::cnvNull($request->zalo_page, '');
            $data->shopee_page = Utils::cnvNull($request->shopee_page, '');
            $data->mail_from = Utils::cnvNull($request->mail_from, '');
            $data->mail_name = Utils::cnvNull($request->mail_name, '');
            if(Auth::user()->role_id == Common::SUPER_ADMIN) {
                $data->upload_banner_maximum_upload = Utils::cnvNull($request->upload_banner_maximum_upload, '');
                $data->upload_logo_maximum_upload = Utils::cnvNull($request->upload_logo_maximum_upload, '');
                $data->upload_image_maximum_upload = Utils::cnvNull($request->upload_image_maximum_upload, '');
                $data->upload_photo_maximum_upload    = Utils::cnvNull($request->upload_photo_maximum_upload, '');
                $data->upload_web_logo_maximum_upload    = Utils::cnvNull($request->upload_web_logo_maximum_upload, '');
                $data->upload_web_ico_maximum_upload    = Utils::cnvNull($request->upload_web_ico_maximum_upload, '');
                $data->upload_avatar_maximum_upload = Utils::cnvNull($request->upload_avatar_maximum_upload, '');
                $data->upload_banner_image_size = Utils::cnvNull($request->upload_banner_image_size, '');
                $data->upload_logo_image_size = Utils::cnvNull($request->upload_logo_image_size, '');
                $data->upload_image_image_size = Utils::cnvNull($request->upload_image_image_size, '');
                $data->upload_photo_image_size = Utils::cnvNull($request->upload_photo_image_size, '');
                $data->upload_web_logo_image_size = Utils::cnvNull($request->upload_web_logo_image_size, '');
                $data->upload_web_ico_image_size = Utils::cnvNull($request->upload_web_ico_image_size, '');
                $data->upload_avatar_image_size = Utils::cnvNull($request->upload_avatar_image_size, '');
                $data->upload_web_banner_maximum_upload = Utils::cnvNull($request->upload_web_banner_maximum_upload, '');
                $data->upload_web_banner_image_size = Utils::cnvNull($request->upload_web_banner_image_size, '');
            }
            $data->off = Utils::cnvNull($request->off, 0);
            $data->bank_info = Utils::cnvNull($request->bank_info, '');
            $data->cash_info = Utils::cnvNull($request->cash_info, '');
            if($data->save()) {
                return redirect(route('auth_config'))->with('success', trans('messages.UPDATE_SUCCESS'));
            }
        }
        
        $this->output['data'] = $data;
        return view('auth.form', $this->output);
    }
    
    /**
     * manual
     * @param Request $request
     */
    public function manual(Request $request) {
        $config = Config::first();
        if($request->isMethod('post')) {
            $manual = $request->manual;
            $config->manual = $manual;
            $config->save();
            return redirect(route('auth_manual'))->with('success', trans('messages.UPDATE_SUCCESS'));
        }
        $manual = $config->manual;
        return view('auth.config.manual', compact('manual'));
    }
}
