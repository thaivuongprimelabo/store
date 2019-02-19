<?php

namespace App\Helpers;

use App\Constants\Common;
use App\Constants\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Image;
use App\Category;
use App\Config;
use App\Vendor;

class Utils {
    
    public static function getImageLink($image = '') {
        if(strpos($image, ',') != -1) {
            $arrImage = explode(',', $image);
            $image = $arrImage[0];
        }
        
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
            return url($noavatar);
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
            case Common::SIZES:
                $data = DB::table($table)->select('name', 'id')->where('status', Status::ACTIVE)->get();
                break;
            default:
                $data = [
                    ['id' => Common::ADMIN, 'name' => trans('auth.role.admin')],
                    ['id' => Common::MEMBER, 'name' => trans('auth.role.member')]
                ];
                break;
        }
        
        foreach($data as $item) {
            if($selected == $item->id) {
                $html .= '<option value="'. $item->id .'" selected>'. $item->name .'</option>';
            } else {
                $html .= '<option value="'. $item->id .'">'. $item->name .'</option>';
            }
        }
        
        return $html;
    }
    
    public static function createCheckboxList($table = '', $selected = '') {
        $html = '';
        $data = [];
        switch($table) {
            case Common::CATEGORIES:
                $data = Category::select('name', 'id')->where('parent_id', 0)->where('status', Status::ACTIVE)->get();
                break;
            case Common::VENDORS:
            case Common::SIZES:
            case Common::COLORS:
                $data = DB::table($table)->select('name', 'id')->where('status', Status::ACTIVE)->get();
                break;
            default:
                $data = [
                ['id' => Common::ADMIN, 'name' => trans('auth.role.admin')],
                ['id' => Common::MEMBER, 'name' => trans('auth.role.member')]
                ];
                break;
        }
        
        $selectedId = explode(',', $selected);
        
        foreach($data as $item) {
            if($table != Common::COLORS) {
                if(in_array($item->id, $selectedId)) {
                    $html .= '<label><input type="checkbox" name="'. $table . '[]" value="'. $item->id .'" checked="checked" /> '. $item->name .'</option></label>';
                } else {
                    $html .= '<label><input type="checkbox" name="'. $table . '[]" value="'. $item->id .'" /> '. $item->name .'</option></label>';
                }
            } else {
                if(in_array($item->id, $selectedId)) {
                    $html .= '<label><input type="checkbox" name="'. $table . '[]" value="'. $item->id .'" checked="checked" /><a href="#" style="display:inline-block; width:21px; height:21px; margin-left:5px; margin-bottom:-6px; background-color:'. $item->name .'"></a></label>';
                } else {
                    $html .= '<label><input type="checkbox" name="'. $table . '[]" value="'. $item->id .'" /><a href="#" style="display:inline-block; width:21px; height:21px; margin-left:5px; margin-bottom:-6px; background-color:'. $item->name .'"></a></label>';
                }
            }
        }
        
        return $html;
    }
    
    public static function createVendor() {
        $html = '<div class="manunew">';
        $vendors = Vendor::select('id', 'name', 'name_url', 'logo')->where('status', Status::ACTIVE)->get();
        $count = 1;
        foreach($vendors as $vendor) {
            $html .= '<a href="'. route('vendor', ['vendor' => $vendor->name_url]) .'"><img src="'. self::getImageLink($vendor->logo) .'" /></a>';
        }
        $html .= '</div>';
        return $html;
    }
    
    public static function createSidebar($site = 'auth', $url_ext = '') {
        
        $sidebar = trans('auth.sidebar');
        $html = '';
        $routes = Route::getRoutes();
        $currentRoute = Route::currentRouteName();
        $nameList = $routes->getRoutesByName();
        
        if($site == 'shop') {
            $categories = Category::select('name_url','id','name')->where('status', Status::ACTIVE)->get();
            foreach($categories as $category) {
                $html .= '<li><a href="' . route('category',['slug' => $category['name_url']]) . '">' . Utils::cnvNull($category['name'], '') . '</a></li>';
            }
            
            return $html;
        }
        $html .= '<ul class="sidebar-menu" data-widget="tree">';
        $html .= '<li>';
        $html .= '<a href="' . route('home') .'" target="_blank">';
        $html .= '<i class="fa fa-files-o"></i>';
        $html .= '<span>' . trans('auth.back_to_home') . '</span>';
        $html .= '</a>';
        $html .= '</li>';
        
        foreach($sidebar as $k=>$v) {
            
            if($k == 'pages' || $routes->hasNamedRoute('auth_' . $k) || $routes->hasNamedRoute('auth_' . $k . '_create')) {
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
                
                $list_name_node = trans('auth.sidebar_node');
                foreach($list_name_node as $key=>$value) {
                    $routeNode = $route . ($key == '_list' ? '' : $key);
                    if($routes->hasNamedRoute($routeNode)) {
                        if($currentRoute == $routeNode) {
                            $html .= '<li class="active"><a href="'. route($routeNode) . '"><i class="fa fa-circle-o"></i> '. $value .'</a></li>';
                        } else {
                            $html .= '<li><a href="'. route($routeNode) . '"><i class="fa fa-circle-o"></i> '. $value .'</a></li>';
                        }
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
        
        $html .= '</ul>';
        return $html;
    }
    
    public static function getConfig() {
        
        $config = Config::first();
        return $config;
    }
    
    public static function setConfigMail() {
        
        $config = self::getConfig();
        if(!self::blank($config->mail_account)) {
            \Illuminate\Support\Facades\Config::set('mail.driver', $config->mail_driver);
            \Illuminate\Support\Facades\Config::set('mail.host', $config->mail_host);
            \Illuminate\Support\Facades\Config::set('mail.port', $config->mail_port);
            \Illuminate\Support\Facades\Config::set('mail.from.address', $config->mail_from);
            \Illuminate\Support\Facades\Config::set('mail.from.name', $config->mail_name);
            \Illuminate\Support\Facades\Config::set('mail.encryption', $config->mail_encryption);
            \Illuminate\Support\Facades\Config::set('mail.username', $config->mail_account);
            \Illuminate\Support\Facades\Config::set('mail.password', $config->mail_password);
        }
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
                    if(count($pathToFile)) {
                        foreach($pathToFile as $attach) {
                            $email->attach($attach);
                        }
                    }
                }
                $email->subject($subject);
            });
                
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    public static function createMainNav() {
        $mainNav = trans('shop.main_nav');
        $html = '';
        foreach($mainNav as $key=>$nav) {
            if($key == Route::currentRouteName()) {
                $html .= '<li class="active"><a href="'. route($key) . '">'. $nav . ' </a></li>';
            } else {
                $html .= '<li><a href="'. route($key) . '">'. $nav . ' </a></li>';
            }
        }
        
        return $html;
    }
    
    public static function createNameUrl($str) {
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $kq = str_replace("'", "''", $str);
        
        return self::url_title(strtolower($kq));
    }
    
    private static function url_title($str, $separator = '-', $lowercase = FALSE)
    {
        if ($separator === 'dash')
        {
            $separator = '-';
        }
        elseif ($separator === 'underscore')
        {
            $separator = '_';
        }
        
        $q_separator = preg_quote($separator, '#');
        
        $trans = array(
            '&.+?;'			=> '',
            '[^\w\d _-]'		=> '',
            '\s+'			=> $separator,
            '('.$q_separator.')+'	=> $separator
        );
        
        $str = strip_tags($str);
        foreach ($trans as $key => $val)
        {
            $str = preg_replace('#'.$key.'#i'.(true ? 'u' : ''), $val, $str);
        }
        
        if ($lowercase === TRUE)
        {
            $str = strtolower($str);
        }
        
        return trim(trim($str, $separator));
    }
    
    public static function createFriendlyUrl($segment, $ext) {
        $url = implode('/', $segment) . $ext;
        return $url;
    }
    
    public static function getDiscountPrice($price, $discount) {
        return $price - ($price * ($discount / 100));
    }

    
}