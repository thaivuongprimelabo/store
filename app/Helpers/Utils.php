<?php

namespace App\Helpers;

use App\Constants\Common;
use App\Constants\Status;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Image;
use App\Category;
use App\Config;
use App\Vendor;

class Utils {
    
    public static function getImageLink($image = '') {
        $uploadFolder = Common::UPLOAD_FOLDER;
        //$nologo = Common::NO_LOGO_FILE;
        if(!self::blank($image)) {
            return url($uploadFolder . $image);
        } else {
            //return url($uploadFolder . $nologo);
            return '';
        }
    }
    
    public static function getAvatar($image = '') {
        $uploadFolder = Common::UPLOAD_FOLDER;
        $noavatar = Common::NO_AVATAR;
        if(!self::blank($image)) {
            return url($uploadFolder . $image);
        } else {
            return url($uploadFolder . $noavatar);
        }
    }
    
    public static function uploadFile($file, $destFolder, $resize = false, $maxWidth = 0, $maxHeight = 0) {
        
        $uploadFolder = Common::UPLOAD_FOLDER;
        $uploadPath = $uploadFolder . $destFolder;
        
        $filename = time() . '_' . $file->getClientOriginalName();
        
        if($resize) {
            self::resizeImage($uploadPath, $file, $filename, $maxWidth, $maxHeight);
        } else {
            $file->move($uploadPath, $filename);
        }
        
        $filename = $destFolder . $filename;
        
        return $filename;
    }
    
    public static function createIcoFile($file, $filename) {
        $uploadPath = Common::UPLOAD_FOLDER;
        $resizePath = $uploadPath . Common::ICO_FOLDER;
        $image_resize = Image::make($file->getRealPath());
        $image_resize->resize(Common::ICO_WIDTH, Common::ICO_HEIGHT);
        
        if(!file_exists(public_path($uploadPath))) {
            mkdir(public_path($uploadPath));
        }
        
        if(!file_exists(public_path($resizePath))) {
            mkdir(public_path($resizePath));
        }
        
        $image_resize->save(public_path($resizePath . $filename));
        
        return Common::ICO_FOLDER . $filename;
    }
    
    public static function resizeImage($uploadPath, $file, $filename, $width = '', $height = '') {
        
        $image_resize = Image::make($file->getRealPath());
        $image_resize->resize($width, $height);
        
        if(!file_exists(public_path($uploadPath))) {
            mkdir(public_path($uploadPath));
        }
        
        $image_resize->save(public_path($uploadPath . $filename));
    }
    
    public static function removeFile($file) {
        $filepath = Common::UPLOAD_FOLDER . $file;
        if(file_exists($filepath)) {
            unlink($filepath);
        }
    }
    
    public static function formatMemory($memory, $number = false)
    {
        if(!$number) {
            if ($memory >= 1024 * 1024 * 1024) {
                return sprintf('%.1f GB', $memory / 1024 / 1024 / 1024);
            }
            
            if ($memory >= 1024 * 1024) {
                return sprintf('%.1f MB', $memory / 1024 / 1024);
            }
            
            if ($memory >= 1024) {
                return sprintf('%d KB', $memory / 1024);
            }
            
            return sprintf('%d B', $memory);
            
        } else {
            if ($memory >= 1024 * 1024 * 1024) {
                return sprintf('%.1f', $memory / 1024 / 1024 / 1024);
            }
            
            if ($memory >= 1024 * 1024) {
                return sprintf('%.1f', $memory / 1024 / 1024);
            }
            
            if ($memory >= 1024) {
                return sprintf('%d', $memory / 1024);
            }
            
            return sprintf('%d', $memory);
        }
        
        
    }
    
    public static function getValidateMessage($key, $param, $param2 = '') {
        $message = trans($key);
        $message = str_replace(':size', trans($param2), $message);
        $message = str_replace(':max', trans($param2), $message);
        $message = str_replace(':attribute', trans($param), $message);
        $message = str_replace(':equal', trans($param2), $message);
        return $message;
    }
    
    public static function replaceMessageParam($key, $params = []) {
        $message = trans($key);
        for($i = 0; $i < count($params); $i++) {
            $message = str_replace('{' . $i . '}', $params[$i], $message);
        }
        return $message;
    }
        
    /**
     * Determine if the given value is "blank".
     *
     * @param  mixed  $value
     * @return bool
     */
    public static function blank($value)
    {
        if (is_null($value)) {
            return true;
        }
        
        if (is_string($value)) {
            return trim($value) === '';
        }
        
        if (is_numeric($value) || is_bool($value)) {
            return false;
        }
        
        return empty($value);
    }
    
    public static function cnvNull($value, $default = '') {
        if(self::blank($value)) {
            return $default;
        }
        return $value;
    }
    
    public static function createSelectList($table = '', $selected = '') {
        $html = '';
        $data = [];
        switch($table) {
            case Common::CATEGORIES:
                $data = Category::select('name', 'id')->where('parent_id', 0)->where('status', Status::ACTIVE)->get();
                break;
            case Common::VENDORS:
                $data = Vendor::select('name', 'id')->where('status', Status::ACTIVE)->get();
                break;
            default:
                $data = [
                    ['id' => Common::ADMIN, 'name' => trans('auth.role.admin')],
                    ['id' => Common::MEMBER, 'name' => trans('auth.role.member')]
                ];
                break;
        }
        
        foreach($data as $item) {
            if($selected == $item['id']) {
                $html .= '<option value="'. $item['id'] .'" selected>'. $item['name'] .'</option>';
            } else {
                $html .= '<option value="'. $item['id'] .'">'. $item['name'] .'</option>';
            }
        }
        
        return $html;
    }
    
    public static function createSidebar() {
        $sidebar = trans('auth.sidebar');
        $html = '';
        $routes = Route::getRoutes();
        $currentRoute = Route::currentRouteName();
        $nameList = $routes->getRoutesByName();
        
        foreach($sidebar as $k=>$v) {
            
            if($routes->hasNamedRoute('auth_' . $k) || $routes->hasNamedRoute('auth_' . $k . '_create')) {
                $open = '';
                $treemenu = '';
                $route = 'auth_' . $k;
                $active = '';
                if(strpos($currentRoute, $route) > -1) {
                    $open = 'menu-open';
                    $treemenu = 'style="display:block"';
                    $active = 'active';
                }
                
                $html .= '<li class="treeview '. $open . '">';
                $html .= '<a href="javascript:void(0)">';
                $html .= '<i class="fa fa-files-o"></i>';
                $html .= '<span>'. $v .'</span>';
                $html .= '<span class="pull-right-container">';
                $html .= '<i class="fa fa-angle-left pull-right"></i>';
                $html .= '</span>';
                $html .= '</a>';
                $html .= '<ul class="treeview-menu" ' . $treemenu . '>';
                
                $list_name_node = trans('auth.sidebar_node')[0];
                if($routes->hasNamedRoute($route)) {
                    if($currentRoute == $route) {
                        $html .= '<li class="active"><a href="'. route($route) . '"><i class="fa fa-circle-o"></i> '. $list_name_node .'</a></li>';
                    } else {
                        $html .= '<li><a href="'. route($route) . '"><i class="fa fa-circle-o"></i> '. $list_name_node .'</a></li>';
                    }
                }
                
                $create_name_node = trans('auth.sidebar_node')[1];
                if($routes->hasNamedRoute(($route . '_create'))) {
                    if($currentRoute == ($route . '_create')) {
                        $html .= '<li class="active"><a href="'. route($route . '_create') . '"><i class="fa fa-circle-o"></i> '. $create_name_node .'</a></li>';
                    } else {
                        $html .= '<li><a href="'. route($route . '_create') . '"><i class="fa fa-circle-o"></i> '. $create_name_node .'</a></li>';
                    }
                }
                $html .= '</ul>';
                $html .= '</li>';
            } else {
                $html .= '<li>';
                $html .= '<a href="' . route('auth_' . $k) .'">';
                $html .= '<i class="fa fa-files-o"></i>';
                $html .= '<span>'. $v .'</span>';
                $html .= '</a>';
                $html .= '</li>';
            }
            
        }
        
        return $html;
    }
    
    public static function getConfig() {
        
        $config = Config::first();
        return $config;
    }
    
    public static function setConfigMail() {
        
        $config = self::getConfig();
        \Illuminate\Support\Facades\Config::set('mail.driver', $config->mail_driver);
        \Illuminate\Support\Facades\Config::set('mail.host', $config->mail_host);
        \Illuminate\Support\Facades\Config::set('mail.port', $config->mail_port);
        \Illuminate\Support\Facades\Config::set('mail.from.address', $config->mail_from);
        \Illuminate\Support\Facades\Config::set('mail.from.name', $config->mail_name);
        \Illuminate\Support\Facades\Config::set('mail.encryption', $config->mail_encryption);
        \Illuminate\Support\Facades\Config::set('mail.username', $config->mail_account);
        \Illuminate\Support\Facades\Config::set('mail.password', $config->mail_password);
    }
    
    public static function sendMail($config_email = []) {
        
        self::setConfigMail();
        
        try {
            $from = isset($config_email['from'])?$config_email['from']: config('mail.from.address');
            $from_name = isset($config_email['from_name'])?$config_email['from_name']: config('mail.from.name');
            $to = isset($config_email['to'])?$config_email['to']:'';
            $subject = isset($config_email['subject'])?$config_email['subject']:Common::SUBJECT;
            $msg = isset($config_email['msg'])?$config_email['msg']:'';
            $template = isset($config_email['template'])?$config_email['template']:Common::TEMPLATE;
            $cc = isset($config_email['cc'])?$config_email['cc']:null;
            $bcc = isset($config_email['bcc'])?$config_email['bcc']:null;
            $pathToFile = isset($config_email['pathToFile'])?$config_email['pathToFile']:null;
            
            Mail::send($template, $msg, function ($email) use ($from, $from_name, $to, $subject, $cc, $bcc, $pathToFile) {
                if ($from_name != '') {
                    $email->from($from, $from_name);
                } else {
                    $email->from($from, $from);
                }
                $email->to($to);
                if ($cc !== null) {
                    $email->cc($cc);
                }
                if ($bcc !== null) {
                    $email->bcc($bcc);
                }
                if ($pathToFile !== null) {
                    $email->attach($pathToFile);
                }
                $email->subject($subject);
            });
                
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    
    public static function createValidateRule($site = 'server', $rules) {
        if($site == 'client') {
            
        }
    }
}