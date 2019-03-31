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
                
                DB::table('categories')->truncate();
                DB::table('vendors')->truncate();
                DB::table('products')->truncate();
                DB::table('images_product')->truncate();
                DB::table('sizes')->truncate();
                DB::table('colors')->truncate();
                DB::table('posts')->truncate();
                DB::table('banners')->truncate();
                DB::table('orders')->truncate();
                DB::table('order_details')->truncate();
                DB::table('customers')->truncate();
                DB::table('contacts')->truncate();
                echo '=============== Done! =============== ';
                exit;
            }
            $icoFile = $data->web_ico;
            $filename = $data->web_logo;
            Utils::doUpload($request, Common::WEBLOGO_FOLDER, $filename);
            Utils::createIcoFile($request, $icoFile);
            $data->web_title       = Utils::cnvNull($request->web_title, '');
            $data->web_description = Utils::cnvNull($request->web_description, '');
            $data->web_keywords    = Utils::cnvNull($request->web_keywords, '');
            $data->web_logo        = $filename;
            $data->web_ico         = $icoFile;
            $data->web_email       = Utils::cnvNull($request->web_email, '');
            $data->url_ext         = Utils::cnvNull($request->url_ext, '');
            
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
                return redirect(route('auth_config_edit'))->with('success', trans('messages.UPDATE_SUCCESS'));
            }
        }
        
        $name = $this->name;
        return view('auth.config.index', compact('data', 'name'));
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
