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
            $filename = $config->web_logo;
            if($request->hasFile('web_logo')) {
                
                $file = $request->web_logo;
                
                $filename = Utils::uploadFile($file, Common::WEBLOGO_FOLDER);
            }
            $config->web_title       = $request->input('web_title', '');
            $config->web_description = $request->input('web_description', '');
            $config->web_keywords    = $request->input('web_keywords', '');
            $config->web_logo        = $filename;
            $config->web_email       = $request->input('web_email', '');
            $config->mail_driver     = $request->input('mail_driver', '');
            $config->mail_host       = $request->input('mail_host', '');
            $config->mail_port       = $request->input('mail_port', '');
            $config->mail_from       = $request->input('mail_from', '');
            $config->mail_name       = $request->input('mail_name', '');
            $config->mail_encryption = $request->input('mail_encryption', '');
            $config->mail_account    = $request->input('mail_account', '');
            $config->mail_password   = $request->input('mail_password', '');
            $config->off             = $request->input('off', 0);
            
            if($config->save()) {
                return redirect(route('auth_config'))->with('success', trans('messages.UPDATE_SUCCESS'));
            }
        }
        return view('auth.config.index', compact('config'));
    }
}
