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
                    DB::table('services')->truncate();
                    DB::table('service_groups')->truncate();
                    DB::table('posts')->truncate();
                    DB::table('banners')->truncate();
                    DB::table('orders')->truncate();
                    DB::table('order_details')->truncate();
                    DB::table('contacts')->truncate();
                    
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
                    DB::query('ALTER TABLE services AUTO_INCREMENT = 1');
                    DB::query('ALTER TABLE service_groups AUTO_INCREMENT = 1');
                    
                    $users = [
                        ['id' => 1, 'name' => 'Super Administrator',
                            'email' => 'super.admin@admin.com',
                            'password' => Hash::make('!23456Abc'),
                            'role_id' => Common::SUPER_ADMIN,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                        ['id' => 2, 'name' => 'Administrator',
                            'email' => 'admin@admin.com',
                            'password' => Hash::make('!23456Abc'),
                            'role_id' => Common::ADMIN,
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
//             Utils::doUpload($request, Common::WEBLOGO_FOLDER, $filename);
            Utils::doUploadSimple($request, 'web_logo', $web_logo);
            Utils::doUploadSimple($request, 'web_ico', $web_ico);
//             Utils::doUpload($request, Common::ICO_FOLDER, $filename);
            $data->web_title       = Utils::cnvNull($request->web_title, '');
            $data->web_description = Utils::cnvNull($request->web_description, '');
            $data->web_keywords    = Utils::cnvNull($request->web_keywords, '');
            $data->web_logo        = $web_logo;
            $data->web_ico         = $web_ico;
            $data->web_email       = Utils::cnvNull($request->web_email, '');
            $data->url_ext         = Utils::cnvNull($request->url_ext, '');
            $data->web_address = Utils::cnvNull($request->web_address, '');
            $data->web_email = Utils::cnvNull($request->web_email, '');
            $data->web_hotline = Utils::cnvNull($request->web_hotline, '');
            $data->web_working_time = Utils::cnvNull($request->web_working_time, '');
            
            if(Auth::user()->role_id == Common::SUPER_ADMIN) {
                $data->mail_driver     = Utils::cnvNull($request->mail_driver, '');
                $data->mail_host       = Utils::cnvNull($request->mail_host, '');
                $data->mail_port       = Utils::cnvNull($request->mail_port, '');
                $data->mail_from       = Utils::cnvNull($request->mail_from, '');
                $data->mail_name       = Utils::cnvNull($request->mail_name, '');
                $data->mail_encryption = Utils::cnvNull($request->mail_encryption, '');
                $data->mail_account    = Utils::cnvNull($request->mail_account, '');
                $data->mail_password   = Utils::cnvNull($request->mail_password, '');
                $data->banners_maximum_upload = Utils::cnvNull($request->banners_maximum_upload, '');
                $data->vendors_maximum_upload = Utils::cnvNull($request->vendors_maximum_upload, '');
                $data->products_maximum_upload = Utils::cnvNull($request->products_maximum_upload, '');
                $data->posts_maximum_upload    = Utils::cnvNull($request->posts_maximum_upload, '');
                $data->web_logo_maximum_upload    = Utils::cnvNull($request->web_logo_maximum_upload, '');
                $data->web_ico_maximum_upload    = Utils::cnvNull($request->web_ico_maximum_upload, '');
                $data->attachment_maximum_upload = Utils::cnvNull($request->attachment_maximum_upload, '');
                $data->users_maximum_upload = Utils::cnvNull($request->users_maximum_upload, '');
                $data->banners_image_size = Utils::cnvNull($request->banners_image_size, '');
                $data->vendors_image_size = Utils::cnvNull($request->vendors_image_size, '');
                $data->products_image_size = Utils::cnvNull($request->products_image_size, '');
                $data->posts_image_size = Utils::cnvNull($request->posts_image_size, '');
                $data->web_logo_image_size = Utils::cnvNull($request->web_logo_image_size, '');
                $data->web_ico_image_size = Utils::cnvNull($request->web_ico_image_size, '');
                $data->users_image_size = Utils::cnvNull($request->users_image_size, '');
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
