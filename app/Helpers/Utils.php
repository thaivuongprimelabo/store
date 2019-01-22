<?php

namespace App\Helpers;

use App\Constants\Common;
use Illuminate\Support\Facades\Storage;
use Image;

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
    
    public static function uploadFile($file, $destFolder) {
        
        $uploadFolder = Common::UPLOAD_FOLDER;
        $uploadPath = $uploadFolder . $destFolder;
        
        
        $filename = time() . '_' . $file->getClientOriginalName();
        self::resizeImage($uploadPath, $file, $filename, 60, 60);
        if($file->move($uploadPath, $filename)) {
            $filename = $destFolder . $filename;
        }
        
        return $filename;
    }
    
    public static function resizeImage($uploadPath, $file, $filename, $width, $height) {
        $resizePath = $uploadPath . 'resize/';
        $image_resize = Image::make($file->getRealPath());
        $image_resize->resize($width, $height);
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
}