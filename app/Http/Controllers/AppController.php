<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
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
        // Config
        $config = Utils::getConfig();

        if($config) {
            $web_logo = Utils::getImageLink($config->web_logo);
            $web_ico = Utils::getImageLink($config->web_ico);
            
            $this->config = [
                'config' => [
                    'web_name' => Utils::cnvNull($config->web_title, 'E-shop'),
                    'web_description' => Utils::cnvNull($config->web_description, $config->web_name),
                    'web_keywords' => Utils::cnvNull($config->web_keywords, $config->web_name),
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
            
            if($config->off == 1) {
                return abort(404);
            }
            View::share($this->config);
        }
    }
    
}
