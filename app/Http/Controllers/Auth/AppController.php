<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
class AppController extends Controller
{
    public $config = [];
    
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
                    'banner_maximum_upload' => Utils::cnvNull($config->banner_maximum_upload, 51200),
                    'logo_maximum_upload' => Utils::cnvNull($config->logo_maximum_upload, 51200),
                    'image_maximum_upload' => Utils::cnvNull($config->image_maximum_upload, 51200),
                    'photo_maximum_upload'   => Utils::cnvNull($config->photo_maximum_upload, 51200),
                    'web_logo_maximum_upload'   => Utils::cnvNull($config->web_logo_maximum_upload, 51200),
                    'avatar_maximum_upload'   => Utils::cnvNull($config->avatar_maximum_upload, 51200),
                    'attachment_maximum_upload'   => Utils::cnvNull($config->attachment_maximum_upload, 51200),
                    
                    'banner_image_size' => Utils::cnvNull($config->banner_image_size, '100x100'),
                    'logo_image_size' => Utils::cnvNull($config->logo_image_size, '100x100'),
                    'image_image_size' => Utils::cnvNull($config->image_image_size, '100x100'),
                    'photo_image_size'   => Utils::cnvNull($config->photo_image_size, '100x100'),
                    'web_logo_image_size'   => Utils::cnvNull($config->web_logo_image_size, '100x100'),
                    'avatar_image_size'   => Utils::cnvNull($config->avatar_image_size, '100x100'),
                    
                    'url_ext' => Utils::cnvNull($config->url_ext, '.html'),
                ]
            ];
            View::share($this->config);
        }
    }
}
