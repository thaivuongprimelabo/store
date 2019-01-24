<?php

namespace App\Constants;

class Common {
    
    CONST UPLOAD_FOLDER = 'upload/';
    CONST VENDOR_FOLDER = 'vendor/';
    CONST BANNER_FOLDER = 'banner/';
    CONST IMAGE_EXT = 'png|jpe?g|gif';
    CONST IMAGE_EXT1 = 'jpeg,png,gif';
    CONST IMAGE_MIMES = 'image/jpg, image/jpeg, image/gif, image/png';
    CONST NO_LOGO_FILE = 'no-logo.png';
    CONST ROW_PER_PAGE = 9;
    CONST LOGO_MAX_SIZE = '512000';
    CONST PRODUCT_MAX_SIZE = '512000';
    CONST BANNER_MAX_SIZE = '512000';
    CONST NAME_MAXLENGTH = 255;
    CONST LINK_MAXLENGTH = 255;
    CONST DESC_MAXLENGTH = 300;
    
    /** Table **/
    CONST USERS = 'users';
    CONST VENDORS = 'vendors';
    CONST CATEGORIES = 'categories';
    CONST BANNERS = 'banners';
    CONST CONTACTS = 'contacts';
}