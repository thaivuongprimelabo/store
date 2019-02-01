<?php

namespace App\Http\Controllers\Auth;

use App\Config;
use App\Constants\Common;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $config_data = Config::first();
        if($request->isMethod('post')) {
            $icoFile = $config_data->web_ico;
            $filename = $config_data->web_logo;
            if($request->hasFile('web_logo')) {
                
                $file = $request->web_logo;

                $icoFileName = 'favico.png';
                $icoFile = Utils::createIcoFile($file, $icoFileName);
                $filename = Utils::uploadFile($file, Common::WEBLOGO_FOLDER);
            }
            $config_data->web_title       = Utils::cnvNull($request->web_title, '');
            $config_data->web_description = Utils::cnvNull($request->web_description, '');
            $config_data->web_keywords    = Utils::cnvNull($request->web_keywords, '');
            $config_data->web_logo        = $filename;
            $config_data->web_ico         = $icoFile;
            $config_data->web_email       = Utils::cnvNull($request->web_email, '');
            $config_data->url_ext         = Utils::cnvNull($request->url_ext, '');
            $config_data->mail_driver     = Utils::cnvNull($request->mail_driver, '');
            $config_data->mail_host       = Utils::cnvNull($request->mail_host, '');
            $config_data->mail_port       = Utils::cnvNull($request->mail_port, '');
            $config_data->mail_from       = Utils::cnvNull($request->mail_from, '');
            $config_data->mail_name       = Utils::cnvNull($request->mail_name, '');
            $config_data->mail_encryption = Utils::cnvNull($request->mail_encryption, '');
            $config_data->mail_account    = Utils::cnvNull($request->mail_account, '');
            $config_data->mail_password   = Utils::cnvNull($request->mail_password, '');
            $config_data->off             = Utils::cnvNull($request->off, 0);
            $config_data->banner_maximum_upload = Utils::cnvNull($request->banner_maximum_upload, '');
            $config_data->logo_maximum_upload = Utils::cnvNull($request->logo_maximum_upload, '');
            $config_data->image_maximum_upload = Utils::cnvNull($request->image_maximum_upload, '');
            $config_data->photo_maximum_upload    = Utils::cnvNull($request->photo_maximum_upload, '');
            $config_data->web_logo_maximum_upload    = Utils::cnvNull($request->web_logo_maximum_upload, '');
            $config_data->attachment_maximum_upload = Utils::cnvNull($request->attachment_maximum_upload, '');
            $config_data->avatar_maximum_upload = Utils::cnvNull($request->avatar_maximum_upload, '');
            $config_data->banner_image_size = Utils::cnvNull($request->banner_image_size, '');
            $config_data->logo_image_size = Utils::cnvNull($request->logo_image_size, '');
            $config_data->image_image_size = Utils::cnvNull($request->image_image_size, '');
            $config_data->photo_image_size = Utils::cnvNull($request->photo_image_size, '');
            $config_data->web_logo_image_size = Utils::cnvNull($request->web_logo_image_size, '');
            $config_data->avatar_image_size = Utils::cnvNull($request->avatar_image_size, '');
            
            if($config_data->save()) {
                return redirect(route('auth_config_edit'))->with('success', trans('messages.UPDATE_SUCCESS'));
            }
        }
        return view('auth.config.index', compact('config_data'));
    }
}
