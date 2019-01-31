<?php

namespace App\Http\Controllers\Auth;

use App\Config;
use App\Constants\Common;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request) {
        $config = Config::first();
        if($request->isMethod('post')) {
            $icoFile = $config->web_ico;
            $filename = $config->web_logo;
            if($request->hasFile('web_logo')) {
                
                $file = $request->web_logo;

                $icoFileName = 'favico.png';
                $icoFile = Utils::createIcoFile($file, $icoFileName);
                $filename = Utils::uploadFile($file, Common::WEBLOGO_FOLDER);
            }
            $config->web_title       = Utils::cnvNull($request->web_title, '');
            $config->web_description = Utils::cnvNull($request->web_description, '');
            $config->web_keywords    = Utils::cnvNull($request->web_keywords, '');
            $config->web_logo        = $filename;
            $config->web_ico         = $icoFile;
            $config->web_email       = Utils::cnvNull($request->web_email, '');
            $config->mail_driver     = Utils::cnvNull($request->mail_driver, '');
            $config->mail_host       = Utils::cnvNull($request->mail_host, '');
            $config->mail_port       = Utils::cnvNull($request->mail_port, '');
            $config->mail_from       = Utils::cnvNull($request->mail_from, '');
            $config->mail_name       = Utils::cnvNull($request->mail_name, '');
            $config->mail_encryption = Utils::cnvNull($request->mail_encryption, '');
            $config->mail_account    = Utils::cnvNull($request->mail_account, '');
            $config->mail_password   = Utils::cnvNull($request->mail_password, '');
            $config->off             = Utils::cnvNull($request->off, 0);
            $config->banner_maximum_upload = Utils::cnvNull($request->banner_maximum_upload, '');
            $config->logo_maximum_upload = Utils::cnvNull($request->logo_maximum_upload, '');
            $config->image_maximum_upload = Utils::cnvNull($request->image_maximum_upload, '');
            $config->photo_maximum_upload    = Utils::cnvNull($request->photo_maximum_upload, '');
            $config->web_logo_maximum_upload    = Utils::cnvNull($request->web_logo_maximum_upload, '');
            $config->attachment_maximum_upload = Utils::cnvNull($request->attachment_maximum_upload, '');
            $config->avatar_maximum_upload = Utils::cnvNull($request->avatar_maximum_upload, '');
            $config->banner_image_size = Utils::cnvNull($request->banner_image_size, '');
            $config->logo_image_size = Utils::cnvNull($request->logo_image_size, '');
            $config->image_image_size = Utils::cnvNull($request->image_image_size, '');
            $config->photo_image_size = Utils::cnvNull($request->photo_image_size, '');
            $config->web_logo_image_size = Utils::cnvNull($request->web_logo_image_size, '');
            $config->avatar_image_size = Utils::cnvNull($request->avatar_image_size, '');
            
            if($config->save()) {
                return redirect(route('auth_config_edit'))->with('success', trans('messages.UPDATE_SUCCESS'));
            }
        }
        return view('auth.config.index', compact('config'));
    }
}
