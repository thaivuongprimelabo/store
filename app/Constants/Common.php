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
    CONST ICO_EXT = 'png|ico';
    CONST IMAGE_EXT1 = 'jpeg,png,gif';
    CONST FILE_EXT = 'png|jpe?g|gif|pdf|doc|docx|xlsx|xls';
    CONST FILE_EXT1 = 'jpeg,png,gif,pdf,doc,docx,xlsx,xls';
    CONST IMAGE_MIMES = 'image/jpg, image/jpeg, image/gif, image/png';
    CONST FILE_MIMES = 'image/jpg, image/jpeg, image/gif, image/png, application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/msword, 	application/vnd.ms-excel';
    CONST NO_LOGO_FILE = 'upload/no-image-icon-6.png';
    CONST NO_AVATAR = 'admin/dist/img/user2-160x160.jpg';
    CONST ROW_PER_PAGE = 10;
    CONST LIMIT_PRODUCT_SHOW = 9;
    CONST LIMIT_PRODUCT_SHOW_SIDEBAR = 5;
    CONST LIMIT_PRODUCT_SHOW_TAB = 8;
    CONST LIMIT_POST_SHOW = 6;
    CONST LOGO_MAX_SIZE = '512000';
    CONST LOGO_WIDTH = '120';
    CONST LOGO_HEIGHT = '100';
    CONST PRODUCT_MAX_SIZE = '512000';
    CONST PRODUCT_WIDTH = '150';
    CONST PRODUCT_HEIGHT = '100';
    CONST ATTACHMENT_MAX_SIZE = '102400';
    CONST ATTACHMENT_WIDTH = '90';
    CONST ATTACHMENT_HEIGHT = '90';
    CONST PHOTO_MAX_SIZE = '102400';
    CONST PHOTO_WIDTH = '150';
    CONST PHOTO_HEIGHT = '100';
    CONST IMAGE_MAX_SIZE = '102400';
    CONST IMAGE_WIDTH = '60';
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
    CONST NAME_MAXLENGTH = 120;
    CONST LINK_MAXLENGTH = 255;
    CONST DESC_MAXLENGTH = 300;
    CONST PRICE_MAXLENGTH = 11;
    CONST EMAIL_MAXLENGTH = 150;
    CONST PASSWORD_MAXLENGTH = 40;
    CONST PASSWORD_MINLENGTH = 6;
    CONST DISCOUNT_MAXLENGTH = 3;
    
    CONST U = '_maximum_upload';
    CONST S = '_image_size';
    
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
    CONST PAGES = 'pages';
    CONST ORDERS = 'orders';
    CONST ORDER_DETAILS = 'order_details';
    CONST MEMBERS = 'members';
    CONST THREADS = 'threads';
    CONST GROUPS = 'groups';
    CONST COMMENTS = 'comments';
    CONST SERVICES = 'services';
    CONST SERVICE_GROUPS = 'service_groups';
    CONST PRODUCT_DETAILS = 'product_details';
    CONST PRODUCT_DETAIL_GROUPS = 'product_detail_groups';
    CONST POST_GROUPS = 'post_groups';
    
    /** Role **/
    CONST SUPER_ADMIN = '0';
    CONST ADMIN = '1';
    CONST MOD = '2';
    
    /** Mail **/
    CONST ADMIN_EMAIL = 'thaivuong1503@gmail.com';
    CONST ADMIN_NAME = 'System';
    CONST SUBJECT = '【CPanel】 Test send mail';
    CONST TEMPLATE = 'auth.emails.template';
    
    /** Size */
    CONST UPLOAD_SIZE_LIMIT = ['51200', '102400', '512000', '1024000'];
    
    CONST CURRENCY = '₫';
    
    public static function getValue($key) {
        return constant('Common::' . $key);
    }
    
    
}