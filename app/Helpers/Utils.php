<?php

namespace App\Helpers;

use App\Constants\Common;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Image;
use App\Category;

class Utils {
    
    public static function getImageLink($image) {
        $uploadFolder = Common::UPLOAD_FOLDER;
        $nologo = Common::NO_LOGO_FILE;
        if(!self::blank($image)) {
            return url($uploadFolder . $image);
        } else {
            return url($uploadFolder . $nologo);
        }
    }
    
    public static function uploadFile($file, $destFolder, $resize = true) {
        
        $uploadFolder = Common::UPLOAD_FOLDER;
        $uploadPath = $uploadFolder . $destFolder;
        
        $filename = time() . '_' . $file->getClientOriginalName();
        if($resize) {
            self::resizeImage($uploadPath, $file, $filename, 60, 60);
        }
        if($file->move($uploadPath, $filename)) {
            $filename = $destFolder . $filename;
        }
        
        return $filename;
    }
    
    public static function resizeImage($uploadPath, $file, $filename, $width, $height) {
        $resizePath = $uploadPath . 'resize/';
        $image_resize = Image::make($file->getRealPath());
        $image_resize->resize($width, $height);
        
        if(!file_exists(public_path($uploadPath))) {
            mkdir(public_path($uploadPath));
        }
        
        if(!file_exists(public_path($resizePath))) {
            mkdir(public_path($resizePath));
        }
        $image_resize->save(public_path($resizePath . $filename));
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
    
    public static function getValidateMessage($key, $param, $size = '') {
        $message = trans($key);
        $message = str_replace(':size', trans($size), $message);
        $message = str_replace(':max', trans($size), $message);
        $message = str_replace(':attribute', trans($param), $message);
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
    
    public static function createSelectList($table, $selected = '') {
        $html = '<option value="0">' . trans('auth.categories.parent_empty_text') . '</option>';
        $data = [];
        switch($table) {
            case Common::CATEGORIES:
                $data = Category::select('name', 'id')->where('parent_id', 0)->get();
                break;
            default:
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
    
    public static function sendMail($config_email = []) {
        
        try {
            $from = isset($config_email['from'])?$config_email['from']:Common::ADMIN_EMAIL;
            $from_name = isset($config_email['from_name'])?$config_email['from_name']:Common::ADMIN_NAME;
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
            echo $e->getMessage();
            return false;
        }
    }
}