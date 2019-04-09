<?php

namespace App\Constants;

class UploadPath {
    
    CONST UPLOAD = 'upload/';
    CONST ICO = 'web_ico/';
    CONST WEB_LOGO = 'web_logo/';
    CONST VENDOR_LOGO = 'vendor/';
    CONST BANNER = 'banner/';
    CONST PHOTO = 'photo/';
    CONST AVATAR = 'avatar/';
    CONST PRODUCT = 'product/';
    
    CONST PATH_LIST = [
        'upload_web_ico'    => self::ICO,
        'upload_web_logo'   => self::WEB_LOGO,
        'upload_logo'       => self::VENDOR_LOGO,
        'upload_banner'     => self::BANNER,
        'upload_photo'      => self::PHOTO,
        'upload_avatar'     => self::AVATAR,
        'upload_image'      => self::PRODUCT
    ];
    
    public static function getUploadPath($key = '') {
        
        return self::UPLOAD . self::PATH_LIST[$key];
    }
    
    public static function getFilePath($key = '') {
        return self::PATH_LIST[$key];
    }
}