<?php

namespace App\Helpers;

use App\Constants\Common;
use App\Constants\ContactStatus;
use App\Constants\Status;
use App\Constants\StatusOrders;
use App\Constants\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Image;
use App\Category;
use App\Config;
use App\Vendor;
use Carbon\Carbon;

class Utils {
    
    public static function getImageLink($image = '') {
        
        if(strpos($image, ',') !== FALSE) {
            $arrImage = explode(',', $image);
            $image = $arrImage[0];
        }
        
        if(strpos($image, 'https') !== FALSE || strpos($image, 'http') !== FALSE) {
            return $image;
        }
        
        $uploadFolder = Common::UPLOAD_FOLDER;
        if(!self::blank($image)) {
            return url($uploadFolder . $image);
        } else {
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
    
    public static function doUpload($request, $destFolder, &$filename = '', $product_id = 0, &$arrFilenames = []) {
        $image_upload_url = $request->image_upload_url;
        $image_ids = $request->image_ids;
        $files = $request->image_upload;
        
        if(is_array($image_ids) && count($image_ids)) {
            $ids = [];
            foreach($image_ids as $k=>$v) {
                $url = isset($image_upload_url[$k]) ? $image_upload_url[$k] : '';
                if(!Utils::blank($url)) {
                    $filename = $url;
                }
                
                $file = isset($files[$k]) ? $files[$k] : '';
                if(!Utils::blank($file)) {
                    $filename = self::uploadFile($file, $destFolder);
                }
                
                if($product_id > 0 && !Utils::blank($filename)) {
                    array_push($arrFilenames, ['product_id' => $product_id, 'image' => $filename]);
                }
                
                if($v != 9999) {
                    array_push($ids, $v);
                }
            }
            
            if($product_id > 0) {
                if(count($ids)) {
                    DB::table(Common::IMAGES_PRODUCT)->where('product_id', $product_id)->whereNotIn('id', $ids)->delete();
                }
                
                if(count($arrFilenames)) {
                    DB::table(Common::IMAGES_PRODUCT)->insert($arrFilenames);
                }
            }
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
    
    public static function createIcoFile($request, &$icoFile = '') {
        if($request->hasFile('web_ico')) {
            
            $file = $request->web_ico;
            
            $uploadPath = Common::UPLOAD_FOLDER;
            $resizePath = $uploadPath . Common::ICO_FOLDER;
            $image_resize = Image::make($file->getRealPath());
            
            $image_resize->resize(Common::ICO_WIDTH, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            
            if(!file_exists(public_path($uploadPath))) {
                mkdir(public_path($uploadPath));
            }
            
            if(!file_exists(public_path($resizePath))) {
                mkdir(public_path($resizePath));
            }
            
            $icoFile = Common::ICO_FOLDER . time() . '_ico.png';
            
            $image_resize->save(public_path($uploadPath . $icoFile));
        }
        
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
        if(!self::blank($file)) {
            $filepath = Common::UPLOAD_FOLDER . $file;
            if(file_exists($filepath)) {
                unlink($filepath);
            }
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
    
    public static function getValidateMessage($key, $param = '', $param2 = '') {
        
        if(!self::blank($param) && strpos($param, 'auth.') !== FALSE) {
            $param = str_replace('.text', '', $param);
            $param = $param . '.text';
        }
        
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
            case 'UPLOAD_SIZE_LIMIT':
                $uploadLimits = Common::UPLOAD_SIZE_LIMIT;
                foreach($uploadLimits as $limit) {
                    array_push($data,['id' => $limit, 'name' => self::formatMemory($limit)]);
                }
                break;
            case 'BANNER_TYPE':
                $bannerType = trans('auth.banner_type');
                foreach($bannerType as $key=>$value) {
                    array_push($data,['id' => $key, 'name' => $value['text']]);
                }
                break;
            case 'CONTACT_TYPE':
                return ContactStatus::createSelectList($selected);
                break;
            case 'STATUS_ORDERS':
                return StatusOrders::createSelectList($selected);
                break;
            default:
                $data = [];
                break;
        }
        
        foreach($data as $item) {
            $id = is_object($item) ? $item->id : $item['id'];
            $name = is_object($item) ? $item->name : $item['name'];
            if($selected == $id) {
                $html .= '<option value="'. $id .'" selected>'. $name .'</option>';
            } else {
                $html .= '<option value="'. $id .'">'. $name .'</option>';
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
                $data = [];
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
    
    public static function createSidebar() {
        
        $arrUnaccess = [
            'users'
        ];
        
        $html = '';
        $routes = Route::getRoutes();
        $currentRoute = Route::currentRouteName();
        $open = '';
        $display = '';
        $sidebar = trans('auth.sidebar');
        $html .= '';
        foreach($sidebar as $k=>$v) {
            $open = $display = '';
            $roleId = Auth::user()->role_id;
            if($roleId == Common::MOD && in_array($k, $arrUnaccess)) {
                continue;
            }
            
            if(!is_array($v)) {
                $html .= '<li><a href="' . route('auth_' . $k) . '"><i class="fa fa-files-o"></i><span>' . $v . '</span></a></li>';
            } else {
                
                $key = explode('_', $currentRoute);
                if(key_exists($key[1], $v) || $key[1] == $k) {
                    $open = 'menu-open';
                    $display = 'style="display: block;"';
                }
                $html .= '<li class="treeview ' . $open . '">';
                $html .= '<a href="javascript:void(0)"><i class="fa fa-files-o"></i><span>' . $v['title'] . '</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>';
                $html .= '<ul class="treeview-menu" ' . $display . '>';
                foreach($v as $kk=>$vv) {
                    if($routes->hasNamedRoute('auth_' . $kk)) {
                        $html .= '<li><a href="' . route('auth_' . $kk) . '"><i class="fa fa-circle-o"></i> ' . $vv . '</a></li>';
                    }
                }
                $html .= '</ul>';
                $html .= '</li>';
                
            }
            
        }
        
        return $html;
    }
    
    public static function createSidebarShop() {
       $html = '<ul class="category-list">';
       $category = Category::select('id', 'name', 'name_url')->where('avail_flg', 1)->paginate(7);
       foreach($category as $cate) {
           $html .= '<li>';
           $html .= '<a href="' . route('category', ['slug' => $cate->name_url]) . '">' . $cate->name . '</a>';
           $html .= '</li>';
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
        
//         self::setConfigMail();

        $message = '';
        
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
            
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        
        return $message;
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
    
    public static function deleteDir($dirPath) {
        
        if (! is_dir($dirPath)) {
            return true;
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        return rmdir($dirPath);
    }
    
    public static function getYoutubeEmbedUrl($url)
    {
        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
        
        if(isset($matches[1])) {
            $id = $matches[1];
            return 'https://www.youtube.com/embed/' . $id;
        }
        
        return null;
    }
    
    public static function getYoutubeVideoId($url)
    {
        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
        
        if(isset($matches[1])) {
            $id = $matches[1];
            return $id;
        }
        
        return null;
    }
    
    public static function getYoutubeThumbnail($url)
    {
        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
        
        if(isset($matches[1])) {
            $id = $matches[1];
            return 'http://img.youtube.com/vi/' . $id . '/0.jpg';
        }
        
        return null;
    }
    
    public static function formatCurrency($input) {
        return number_format($input, 0, ',', '.');
    }
    
    public static function generateList($config, $name, $data = null, $otherData = null, $key = '') {
        
        $html = '';
        
        $routes = Route::getRoutes();
        
        $table_info = trans('auth.' . $name . '.table_header');
        if(!self::blank($key)) {
            $table_info = trans('auth.' . $name . '.' . $key);
        }
        $data_count = $data->count();
        $footers = [];
        if(count($table_info)) {
            $colWidth = '';
            $thead = '<thead><tr>';
            foreach($table_info as $key=>$info) {
                if(isset($info['tfoot'])) {
                    $footers[$key] = $info;
                    continue;
                }
                if(isset($info['hide'])) {
                    continue;
                }
                $colWidth .= '<col width="' . $info['width'] . '">';
                $thead .= '<th>' . $info['text'] . '</th>';
                
            }
            $thead .= '</thead></tr>';
            
            $tbody = '<tbody><tr><td colspan="' . count($table_info) . '">' . trans('auth.no_data_found') .'</td></tr>';
            if($data_count) {
                $tbody = '<tbody>';
                foreach($data as $item) {
                    $tbody .= '<tr>';
                    foreach($table_info as $key=>$info) {
                        if(isset($info['tfoot']) == 'tfoot') {
                            continue;
                        }
                        
                        switch($key) {
                            case 'category':
                                $tbody .= '<td>' . $item->getCategoryName() . '</td>';
                                break;
                            case 'vendor':
                                $tbody .= '<td>' . $item->getVendorName() . '</td>';
                                break;
                            case 'banner':
                                if($item->select_type == 'use_image') {
                                    $tbody .= '<td><img src="' . self::getImageLink($item->$key) . '" width="200" /></td>';
                                } else {
                                    $tbody .= '<td><img src="http://img.youtube.com/vi/' . $item->youtube_id . '/0.jpg" width="200" /></td>';
                                }
                                break;
                                
                            case 'logo':
                            case 'avatar':
                            case 'photo':
                                $tbody .= '<td><img src="' . self::getImageLink($item->$key) . '" width="80" /></td>';
                                break;
                                
                            case 'images':
                            case 'image':
                                $tbody .= '<td><img src="' . $item->getFirstImage() . '" width="80" /></td>';
                                break;
                                
                            case 'status':
                                $label = '<span class="label label-danger">' . trans('auth.status.unactive') . '</span>';
                                if($item->status == Status::ACTIVE) {
                                    $label = '<span class="label label-success">' . trans('auth.status.active') . '</span>';
                                }
                                $tbody .= '<td><a href="javascript:void(0)" class="update-status" data-id="' . $item->id . '" data-status="' . $item->status . '">' . $label . '</a></td>';
                                break;
                                
                            case 'role_id':
                                
                                $label = '<span class="label label-primary">' . trans('auth.role.super_admin') . '</span>';
                                
                                if($item->role_id == UserRole::ADMIN) {
                                    $label = '<span class="label label-warning">' . trans('auth.role.admin') . '</span>';
                                }
                                
                                $tbody .= '<td><a href="javascript:void(0)" class="update-status">' . $label . '</a></td>';
                                break;
                                
                            case 'price':
                            case 'cost':
                                $tbody .= '<td>' . self::formatCurrency($item->$key) . '</td>';
                                break;
                                
                            case 'created_at':
                            case 'updated_at':
                            case 'published_at':
                                $date = self::formatDate($item->$key);
                                $tbody .= '<td>' . $date . '</td>';
                                break;
                            case 'order_status':
                                $label = '<span class="label label-primary">' . trans('auth.status.order_new') . '</span>';
                                if($item->status == StatusOrders::ORDER_SHIPPING) {
                                    $label = '<span class="label label-warning">' . trans('auth.status.order_shipping') . '</span>';
                                }
                                if($item->status == StatusOrders::ORDER_DONE) {
                                    $label = '<span class="label label-success">' . trans('auth.status.order_done') . '</span>';
                                }
                                if($item->status == StatusOrders::ORDER_CANCEL) {
                                    $label = '<span class="label label-danger">' . trans('auth.status.order_cancel') . '</span>';
                                }
                                
                                $tbody .= '<td>' . $label . '</td>';
                                break;
                                
                            case 'edit_action':
                                if(isset($info['hide'])) {
                                    continue;
                                }
                                
                                $route = 'auth_' . $name . '_edit';
                                if($routes->hasNamedRoute($route)) {
                                    $url = route('auth_' . $name . '_edit',['id' => $item->id]);
                                    $tbody .= '<td align="center"><a href="javascript:void(0)" data-url="' . $url . '" class="edit" title="Edit"><i class="fa fa-pencil" aria-hidden="true" style="font-size: 24px"></i></a></td>';
                                } else {
                                    $tbody .= '<td></td>';
                                }
                                break;
                                
                            case 'remove_action':
                                if(isset($info['hide'])) {
                                    continue;
                                }
                                
                                $route = 'auth_' . $name . '_remove';
                                if($routes->hasNamedRoute($route)) {
                                    $url = route('auth_' . $name . '_remove',['id' => $item->id]);
                                    $tbody .= '<td align="center"><a href="javascript:void(0)" data-url="' . $url . '" class="remove-row" title="Remove"><i class="fa fa-trash" aria-hidden="true" style="font-size: 24px"></i></a></td>';
                                } else {
                                    $tbody .= '<td></td>';
                                }
                                
                                break;
                                
                            default:
                                $tbody .= '<td>' . $item->$key . '</td>';
                                break;
                        }
                        
                    }
                    
                    $tbody .= '</tr>';
                }
            }
            
            $tbody .= '</tbody>';
            $tfoot = '';
            if(count($footers)) {
                $tfoot = '<tfoot>';
                foreach($footers as $key=>$foot) {
                    $tfoot .= '<tr><th class="empty" colspan="' . $foot['colspan'] . '"></th><th>' . $foot['text'] . '</th><th class="sub-total"> ' . self::formatCurrency($otherData->$key) . '</th></tr>';
                }
                $tfoot .= '</tfoot>';
            }
        }
        
        $html .= '<table class="table table-hover" style="table-layout: fixed; word-wrap:break-word;">';
        $html .= $colWidth;
        $html .= $thead;
        
        $html .= $tbody;
        $html .= $tfoot;
        $html .= '</table>';
        
        return $html;
    }
    
    public static function generateForm($config, $name, $data = null, $forms = null) {
        
        $auth_name = trans('auth.' . $name);
        if($forms == null) {
            
            $auth_form = $auth_name['form'];
            if(isset($auth_form['many_form'])) {
                $multi_form_html = '';
                foreach($auth_form as $key=>$forms) {
                    if($key == 'many_form') {
                        continue;
                    }
                    $multi_form_html .= self::generateForm($config, $name, $data, $forms);
                }
                return $multi_form_html;
            } else {
                $forms = $auth_form;
            }
        }
        
        $tabForm = isset($auth_name['tab_form']) ? true : false;
        $id = isset($data->id) ? $data->id : 0;
        $form_html = '';
        
        $header = '<div class="box-header with-border">';
        if(isset($forms['header'])) {
            $header .= '<h3 class="box-title">' . $forms['header'] . '</h3>';
        } else {
            if($id > 0) {
                $header .= '<h3 class="box-title">' . trans('auth.edit_box_title') . '</h3>';
            } else {
                $header .= '<h3 class="box-title">' . trans('auth.create_box_title') . '</h3>';
            }
        }
        $header .= '</div>';
        
        $body = '<div class="box-body">';
        foreach($forms as $key=>$value) {
            $body .= self::createElement($key, $value, $config, $name, $data);
        }
        $body .= '</div>';
        
        if($tabForm) {
            $form_html .= '<input type="hidden" name="id" id="id_check" value="' . $id . '" />';
            $form_html = '';
            $form_html .= '<div class="nav-tabs-custom">';
            $form_html .= '<ul class="nav nav-tabs">';
            $form_html .= '<li class="active">';
            $form_html .= '<a href="#tab-form-1" data-toggle="tab" aria-expanded="true"> '. trans('auth.product_info');
            $form_html .= '</a>';
            $form_html .= '</li>';
            $form_html .= '<li>';
            $form_html .= '<a href="#tab-form-2" data-toggle="tab"> ' . trans('auth.services');
            $form_html .= '</a>';
            $form_html .= '</li>';
            $form_html .= '</ul>';
            $form_html .= '<div class="tab-content fields-group">';
            $form_html .= '<div class="tab-pane active" id="tab-form-1">';
            $form_html .= $body;
            $form_html .= '</div>';
            $form_html .= '<div class="tab-pane" id="tab-form-2">';
            $form_html .= '<div class="btn-group mb-1">';
            $form_html .= '<button id="add_new_service" type="button" class="btn btn-sm btn-success" title="Add new services"><i class="fa fa-plus"></i> ' . trans('auth.button.add_service') . '</button>';
            $form_html .= '</div>';
            $form_html .= '<div id="services" class="form-group">';
            if($data != null) {
                $form_html .= $data->getServices();
            }
            $form_html .= '</div>';
            $form_html .= '</div>';
            $form_html .= '</div>';
            $form_html .= '</div>';
            if($name != 'config') {
                $form_html .= view('auth.common.button_footer',['back_url' => route('auth_' . $name)])->render();
            }
            
        } else {
            $form_html = '<div class="box box-primary">';
            $form_html .= $header;
            $form_html .= '<input type="hidden" name="id" id="id_check" value="' . $id . '" />';
            $form_html .= $body;
            if($name != 'config') {
                $form_html .= view('auth.common.button_footer',['back_url' => route('auth_' . $name)])->render();
            }
            $form_html .= '</div>';
        }
        
        return $form_html;
    }
    
    private static function createElement($key = '', $value = '', $config, $name, $data = null) {
        
        $text = isset($value['text']) ? $value['text'] : '';
        $placeholder = isset($value['placeholder']) ? $value['placeholder'] : $text;
        $maxlength = isset($value['maxlength']) ? $value['maxlength'] : 120;
        $lengthText = str_replace('{0}', $maxlength, trans('auth.length_text'));
        $table = isset($value['table']) ? $value['table'] : '';
        $emptyText = isset($value['empty_text']) ? $value['empty_text'] : '';
        $containerId = isset($value['container_id']) ? $value['container_id'] : '';
        
        if(!Utils::blank($containerId)) {
            if($data != null) {
                $select_type = $data->select_type;
                if($containerId != $select_type) {
                    $containerId = 'select_type ' . $containerId . ' hide_element';
                } else {
                    $containerId = 'select_type ' . $containerId;
                }
            } else {
                $banner_type = trans('auth.banner_type');
                if(!$banner_type[$containerId]['checked']) {
                    $containerId = 'select_type ' . $containerId . ' hide_element';
                } else {
                    $containerId = 'select_type ' . $containerId;
                }
            }
        }
        
        $disable = isset($value['disabled']) ? 'disabled=true' : '';
        $label = '<label>' . $text . '<small>' . $lengthText . '</small></label>';
        $element_value = !is_null($data) && !Utils::blank($data->$key) ? $data->$key : '';
        
        $element_html = '<div class="form-group ' . $containerId . '">';
        $type = isset($value['type']) ? $value['type'] : '';
        $count = isset($value['count']) ? $value['count'] : 0;
        
        switch($type) {
            case 'radio_list':
                
                $element_html = '<div class="radio">';
                
                $radio_values = $value['value'];
                foreach($radio_values as $k=>$v) {
                    
                    $element_html .= '<label>';
                    $element_html .= '<input type="radio" class="' . $key . '" name="' . $key . '" value="' . $k . '" ' . ($v['checked'] || $k == $element_value ? 'checked="checked"' : '') . ' /> ' . $v['text'];
                    $element_html .= '</label>';
                    
                }
                
                break;
                
            case 'youtube_preview':
                
                $element_html .= $label;
                $element_html .= '<div id="youtube_preview">';
                if(!is_null($data) && !Utils::blank($data->youtube_id)) {
                    $element_html .= '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $data->youtube_id . '" frameborder="0" allowfullscreen></iframe>';
                }
                $element_html .= '</div>';
                $element_html .= '<input type="hidden" name="youtube_embed_url" id="youtube_embed_url" value="" />';
                
                break;
                
            case 'textarea':
                
                $element_html .= $label;
                $element_html .= '<textarea class="form-control" rows="6" name="' . $key . '" placeholder="' . $placeholder . '" maxlength="' . $maxlength . '" '. $disable . '>' . $element_value . '</textarea>';
                $element_html .= '<input type="hidden" name="youtube_embed_url" id="youtube_embed_url" value="" />';
                
                break;
                
            case 'text':
                
                if($key == 'youtube_id') {
                    $element_value = !Utils::blank($element_value) ? 'https://www.youtube.com/watch?v=' . $element_value : '';
                }
                
                $element_html .= $label;
                $element_html .= '<div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>';
                $element_html .= '<input type="text" class="form-control" name="' . $key . '" id="' . $key . '" value="' . $element_value . '" placeholder="' . $placeholder . '" maxlength="' . $maxlength . '" '. $disable . ' />';
                $element_html .= '</div>';
                break;
                
            case 'currency':
                
                $element_html .= $label;
                $element_html .= '<div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>';
                $element_html .= '<input type="number" class="form-control" name="' . $key . '" id="' . $key . '" value="' . $element_value . '" placeholder="' . $placeholder . '" maxlength="' . $maxlength . '" '. $disable . ' />';
                
                if(!self::blank($element_value)) {
                    $element_value = self::formatCurrency($element_value);
                }
                $element_html .= '</div>';
                $element_html .= '<span id="format_currency"><strong><small>Định dạng tiền tệ: <i>' . $element_value . '</i></small></strong></span>';
                
                break;
                
            case 'number':
                
                $element_html .= $label;
                $element_html .= '<div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>';
                $element_html .= '<input type="number" class="form-control" name="' . $key . '" id="' . $key . '" value="' . $element_value . '" placeholder="' . $placeholder . '" maxlength="' . $maxlength . '" '. $disable . ' />';
                $element_html .= '</div>';
                break;
                
            case 'email':
                
                $element_html .= $label;
                $element_html .= '<div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>';
                $element_html .= '<input type="email" class="form-control" name="' . $key . '" id="' . $key . '" value="' . $element_value . '" placeholder="' . $placeholder . '" maxlength="' . $maxlength . '" '. $disable . ' />';
                $element_html .= '</div>';
                break;
                
            case 'password':
                
                $element_html .= $label;
                $element_html .= '<div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>';
                $element_html .= '<input type="password" class="form-control" name="' . $key . '" id="' . $key . '" value="" placeholder="' . $placeholder . '" maxlength="' . $maxlength . '" '. $disable . ' />';
                $element_html .= '</div>';
                break;
                
            case 'checkbox':
                
                $checked = '';
                
                $element_html .= '<div class="checkbox">';
                if($element_value || (isset($value['checked']) && $value['checked'])) {
                    $checked = 'checked="checked"';
                }
                
                $element_html .= '<label><input type="checkbox" name="' . $key . '" value="1" ' . $checked . ' />' . $text . '</label>';
                
                $element_html .= '</div>';
                break;
                
            case 'checkbox_multi':
                
                $element_html .= '<label>' .$text . '</label>';
                $element_html .= '<div class="checkbox">';
                $element_html .= '<label>' . self::createCheckboxList($table, $element_value) . '</label>';
                $element_html .= '</div>';
                break;
                
            case 'checkbox_color_multi':
                
                $element_html .= '<label>' .$text . '</label>';
                $element_html .= '<div class="checkbox">';
                $element_html .= '<label>' . self::createCheckboxList($table, $element_value) . '</label>';
                $element_html .= '</div>';
                break;
                
            case 'label':
                
                $element_html .= '<label>' .$text . '</label>&nbsp;&nbsp;&nbsp;';
                $element_html .= '<span>' . $element_value . '</span>';
                break;
                
            case 'link':
                
                $element_html .= '<label>' .$text . '</label>';
                $element_html .= '<a href="mailto:' . $element_value . '">' . $element_value . '</a>';
                break;
                
            case 'file':
                
                if($name != 'accessories') {
                    $image_size = isset($config[$name . '_image_size']) ? $config[$name . '_image_size'] : $config[$key . '_image_size'];
                    $upload_limit = isset($config[$name . '_maximum_upload']) ? $config[$name . '_maximum_upload'] : $config[$key . '_maximum_upload'];
                } else {
                    $image_size = $config['products_image_size'];
                    $upload_limit = $config['products_maximum_upload'];
                }
                
                
                $split = explode('x', $image_size);
                $size = self::formatMemory($upload_limit);
                
                $image_using = [];
                if(!is_null($data)) {
                    if($key == 'image') {
                        $image_using = $data->getAllImage($data->id);
                    } else {
                        $image_using = self::getImageLink($element_value);
                    }
                }
                
                $text_small = trans('auth.text_image_small');
                $file_ext = isset($value['file_ext']) ? $value['file_ext'] : Common::IMAGE_EXT;
                
                
                if($count > 0) {
                    
                    $element_html .= '<label>' . $text . '</label>&nbsp;&nbsp;(' . Utils::replaceMessageParam($text_small,[$size]) . ')<br/>';
                    $element_html .= '<div id="preview_list">';
                    
                    if(count($image_using)) {
                        foreach($image_using as $id=>$image) {
                            $element_html .= '<div class="image_product" style="display: inline-block;">';
                            $element_html .= '<a href="javascript:void(0)" class="add_image" style="width: ' . $split[0] . 'px; height: ' . $split[1] . 'px">';
                            $element_html .= '<img src="' . $image . '" style="width: ' . $split[0] . 'px; height: ' . $split[1] . 'px" />';
                            $element_html .= '</a>';
                            
                            $element_html .= '<a href="javascript:void(0)" class="remove" data-id="' . $id . '"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                            $element_html .= '<input type="hidden" name="image_ids[]" class="upload_image_id" value="' . $id . '" />';
                            $element_html .= '</div>';
                        }
                    }
                    
                    $element_html .= '<div class="image_product" style="display: inline-block;">';
                    $element_html .= '<a href="javascript:void(0)" class="add_image" data-key="' . $key . '" data-demension="' . $image_size . '" data-upload-limit="' . $upload_limit . '" data-file-ext="' . $file_ext . '" style="width: ' . $split[0] . 'px; height: ' . $split[1] . 'px">';
                    $element_html .= '<i class="fa fa-upload" style="font-size: 20px;" aria-hidden="true"></i><br/>' . trans('auth.button.add_image');
                    $element_html .= '</a>';
                    
                    $element_html .= '<input type="hidden" id="upload_index" value="-1" />';
                    $element_html .= '</div>';
                    $element_html .= '</div>';
                } else {
                    $element_html .= '<label>' . $text . '</label>&nbsp;&nbsp;(' . Utils::replaceMessageParam($text_small,[$size]) . ')<br/>';
                    $element_html .= '<div id="preview_list">';
                    $element_html .= '<div  id="' . $key . '_0" class="image_product" style="display: inline-block;">';
                    $element_html .= '<a href="javascript:void(0)" class="upload_image open_upload_dialog" data-demension="' . $image_size . '" data-upload-limit="' . $upload_limit . '" data-file-ext="' . $file_ext . '" style="width: ' . $split[0] . 'px; height: ' . $split[1] . 'px">';
                    
                    if(is_string($image_using)) {
                        $element_html .= '<img src="' . $image_using . '" style="width: ' . $split[0] . 'px; height: ' . $split[1] . 'px" />';
                    } else {
                        $element_html .= '<i class="fa fa-upload" style="font-size: 20px;" aria-hidden="true"></i><br/>' . trans('auth.button.add_image');
                    }
                    
                    $element_html .= '</a>';
                    
                    $element_html .= '<input type="file" name="image_upload[]" class="upload_image_product" style="display: none" />';
                    $element_html .= '<input type="hidden" name="image_upload_url[]" class="upload_image_product_url" />';
                    $element_html .= '<input type="hidden" name="image_ids[]" class="upload_image_id" value="9999" />';
                    
                    $element_html .= '</div>';
                    $element_html .= '</div>';
                }
                
                break;
                
            case 'select':
                $element_html .= '<label>' .$text . '</label>';
                $element_html .= '<select class="form-control" name="' . $key . '" id="' . $key . '">';
                if(!self::blank($emptyText)) {
                    $element_html .= '<option value="">' . $emptyText . '</option>';
                }
                $element_html .= self::createSelectList($table, $element_value);
                $element_html .= '</select>';
                break;
                
            case 'editor':
                $element_html .= '<label>' .$text . '</label>';
                $element_html .= '<textarea name="' . $key . '" id="editor_' . $key . '" class="ckeditor" placeholder="' . $placeholder . '">' . $element_value . '</textarea>';
                break;
                
        }
        $element_html .= '<span class="help-block"></span>';
        $element_html .= '</div>';
        return $element_html;
    }
    
    public static function formatDate($input) {
        $result="";
        try {
            $result = Carbon::createFromFormat('Y-m-d H:i:s', $input)->format('d-m-Y H:i:s');
        } catch (\Exception $e) {
            $result="";
        }
        return $result;
    }
    
    public static function generateValidation($name, $input_rules = []) {
        
        $result = [
            'rules' => [],
            'messages' => []
        ];
        $rules = [];
        $messages = [];
        if(!is_array($input_rules)) {
            return json_encode($result);
        }
        
        foreach($input_rules as $k=>$v) {
            $rules[$k] = [];
            $messages[$k] = [];
            $exp = explode('|', $v);
            foreach($exp as $kk=>$vv) {
                
                $exp1 = explode(':', $vv);
                $rule_name = '';
                $rule_check = '';
                if(isset($exp1[1])) {
                    $rule_name = $exp1[0];
                    $rule_check = $exp1[1];
                } else {
                    $rule_name = $vv;
                    $rule_check = true;
                }
                
                $msg_item = '';
                $item_name = 'auth.' . $name . '.form.' . $k;
                $value_compare = '';
                switch($rule_name) {
                    case 'required':
                        $msg_item = 'validation.required';
                        break;
                    case 'email':
                        $msg_item = 'validation.email';
                        break;
                    case 'max':
                        $rule_name = 'maxlength';
                        $msg_item = 'validation.max.string';
                        $value_compare = $rule_check;
                        break;
                    case 'min':
                        $rule_name = 'minlength';
                        $msg_item = 'validation.min.string';
                        $value_compare = $rule_check;
                    case 'url':
                        $msg_item = 'validation.url';
                        $value_compare = $rule_check;
                        break;
                    default:
                        
                        break;
                }
                
                $rules[$k][$rule_name] = $rule_check;
                
                $messages[$k][$rule_name] = self::getValidateMessage($msg_item, $item_name, $value_compare);
            }
            
        }
        
        $result['rules'] = $rules;
        $result['messages'] = $messages;
        
        return json_encode($result);
    }
}