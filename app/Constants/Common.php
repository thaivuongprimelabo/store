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
    CONST AVATAR_FOLDER = 'avatar/';
    CONST IMAGE_FOLDER = 'image/';
    CONST IMAGE_EXT = 'png|jpe?g|gif';
    CONST IMAGE_EXT1 = 'jpeg,png,gif';
    CONST FILE_EXT = 'png|jpe?g|gif|pdf|doc|docx|xlsx|xls';
    CONST FILE_EXT1 = 'jpeg,png,gif,pdf,doc,docx,xlsx,xls';
    CONST IMAGE_MIMES = 'image/jpg, image/jpeg, image/gif, image/png';
    CONST FILE_MIMES = 'image/jpg, image/jpeg, image/gif, image/png, application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/msword, 	application/vnd.ms-excel';
    CONST NO_LOGO_FILE = 'no-image-icon-6.png';
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
    CONST ATTACHMENT_WIDTH = '90';
    CONST ATTACHMENT_HEIGHT = '90';
    CONST PHOTO_MAX_SIZE = '102400';
    CONST PHOTO_WIDTH = '150';
    CONST PHOTO_HEIGHT = '100';
    CONST IMAGE_MAX_SIZE = '102400';
    CONST IMAGE_WIDTH = '150';
    CONST IMAGE_HEIGHT = '100';
    CONST AVATAR_MAX_SIZE = '102400';
    CONST AVATAR_WIDTH = '150';
    CONST AVATAR_HEIGHT = '100';
    CONST WEB_LOGO_MAX_SIZE = '102400';
    CONST WEB_LOGO_WIDTH = '150';
    CONST WEB_LOGO_HEIGHT = '100';
    CONST WEB_LOGO_ADMIN_WIDTH = '90';
    CONST WEB_LOGO_ADMIN_HEIGHT = '40';
    CONST WEB_LOGO_ADMIN_SMALL_WIDTH = '20';
    CONST WEB_LOGO_ADMIN_SMALL_HEIGHT = '20';
    CONST ICO_WIDTH = '16';
    CONST ICO_HEIGHT = '16';
    CONST ADMIN_IMAGE_WIDTH = '50';
    CONST NAME_MAXLENGTH = 255;
    CONST LINK_MAXLENGTH = 255;
    CONST DESC_MAXLENGTH = 300;
    CONST PRICE_MAXLENGTH = 11;
    CONST PASSWORD_MAXLENGTH = 40;
    
    /** Table **/
    CONST USERS = 'users';
    CONST VENDORS = 'vendors';
    CONST CATEGORIES = 'categories';
    CONST BANNERS = 'banners';
    CONST CONTACTS = 'contacts';
    CONST POSTS = 'posts';
    CONST CONFIG = 'config';
    CONST PRODUCTS = 'products';
    CONST IMAGES_PRODUCT = 'images_product';
    
    /** Role **/
    CONST SUPER_ADMIN = '0';
    CONST ADMIN = '1';
    CONST MEMBER = '2';
    
    /** Mail **/
    CONST ADMIN_EMAIL = 'thaivuong1503@gmail.com';
    CONST ADMIN_NAME = 'System';
    CONST SUBJECT = '【CPanel】 Test send mail';
    CONST TEMPLATE = 'auth.emails.template';
    
}