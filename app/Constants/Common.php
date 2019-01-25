<?php

namespace App\Constants;

class Common {
    
    CONST UPLOAD_FOLDER = 'upload/';
    CONST VENDOR_FOLDER = 'vendor/';
    CONST BANNER_FOLDER = 'banner/';
    CONST PHOTO_FOLDER = 'photo/';
    CONST ATTACHMENT_FOLDER = 'attachment/';
    CONST ICO_FOLDER = 'ico/';
    CONST WEBLOGO_FOLDER = 'web_logo/';
    CONST IMAGE_EXT = 'png|jpe?g|gif';
    CONST IMAGE_EXT1 = 'jpeg,png,gif';
    CONST FILE_EXT = 'png|jpe?g|gif|pdf|doc|docx|xlsx|xls';
    CONST FILE_EXT1 = 'jpeg,png,gif,pdf,doc,docx,xlsx,xls';
    CONST IMAGE_MIMES = 'image/jpg, image/jpeg, image/gif, image/png';
    CONST FILE_MIMES = 'image/jpg, image/jpeg, image/gif, image/png, application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/msword, 	application/vnd.ms-excel';
    CONST NO_LOGO_FILE = 'no-logo.png';
    CONST ROW_PER_PAGE = 9;
    CONST LOGO_MAX_SIZE = '512000';
    CONST LOGO_WIDTH = '200';
    CONST LOGO_HEIGHT = '100';
    CONST PRODUCT_MAX_SIZE = '512000';
    CONST PRODUCT_WIDTH = '150';
    CONST PRODUCT_HEIGHT = '100';
    CONST BANNER_MAX_SIZE = '512000';
    CONST BANNER_WIDTH = '780';
    CONST BANNER_HEIGHT = '350';
    CONST ATTACHMENT_MAX_SIZE = '102400';
    CONST PHOTO_MAX_SIZE = '102400';
    CONST PHOTO_WIDTH = '150';
    CONST PHOTO_HEIGHT = '100';
    CONST WEB_LOGO_MAX_SIZE = '102400';
    CONST WEB_LOGO_WIDTH = '150';
    CONST WEB_LOGO_HEIGHT = '100';
    CONST WEB_LOGO_ADMIN_WIDTH = '90';
    CONST WEB_LOGO_ADMIN_SMALL_WIDTH = '20';
    CONST ICO_WIDTH = '16';
    CONST ICO_HEIGHT = '16';
    CONST NAME_MAXLENGTH = 255;
    CONST LINK_MAXLENGTH = 255;
    CONST DESC_MAXLENGTH = 300;
    
    /** Table **/
    CONST USERS = 'users';
    CONST VENDORS = 'vendors';
    CONST CATEGORIES = 'categories';
    CONST BANNERS = 'banners';
    CONST CONTACTS = 'contacts';
    CONST POSTS = 'posts';
    CONST CONFIG = 'config';
    CONST PRODUCTS = 'products';
    
    /** Mail **/
    CONST ADMIN_EMAIL = 'thaivuong1503@gmail.com';
    CONST ADMIN_NAME = 'System';
    CONST SUBJECT = '【CPanel】 Test send mail';
    CONST TEMPLATE = 'auth.emails.template';
    
}