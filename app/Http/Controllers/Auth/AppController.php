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
                    'banner_maximum_upload' => $config->banner_maximum_upload,
                    'logo_maximum_upload' => $config->vendor_maximum_upload,
                    'image_maximum_upload' => $config->product_maximum_upload,
                    'photo_maximum_upload'   => $config->post_maximum_upload,
                    'banner_image_size' => $config->banner_image_size,
                    'logo_image_size' => $config->vendor_image_size,
                    'image_image_size' => $config->product_image_size,
                    'photo_image_size'   => $config->post_image_size
                ]
            ];
            View::share($this->config);
        }
    }
}
