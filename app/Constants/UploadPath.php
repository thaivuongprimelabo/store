<?php

namespace App\Constants;

class UploadPath {
    
    CONST UPLOAD = 'upload/';
    CONST ICO = 'web_ico/';
    CONST WEB_LOGO = 'web_logo/';
    
    CONST PATH_LIST = [
        'web_ico' => self::ICO,
        'web_logo' => self::WEB_LOGO
    ];
    
    public static function getUploadPath($key = '') {
        
        return self::UPLOAD . self::PATH_LIST[$key];
    }
    
    public static function getFilePath($key = '') {
        return self::PATH_LIST[$key];
    }
}