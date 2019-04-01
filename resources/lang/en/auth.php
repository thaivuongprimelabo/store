<?php

$bannerType = [
    'use_image' => ['checked' => true, 'text' => 'Hình ảnh'],
    'use_youtube' => ['checked' => false, 'text' => 'Youtube Clip']
];

$productType = [
    'normal' => 'Sản phẩm',
    'accessories' => 'Phụ kiện'
];

$auth = [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'title' => 'Control Panel',
    /*------------ Login page ------------------- */
    'login_page_title' => '<b>Control</b>Panel',
    'login_page_top_text' => 'Vui lòng đăng nhập để truy cập hệ thống',
    'email_placeholder' => 'E-mail',
    'password_placeholder' => 'Mật khẩu',
    'remember_me' => 'Duy trì đăng nhập',
     /*------------ Dashboard page ------------------- */
    'dashboard_page_title' => '<b>C</b>Panel',
    'back_to_home' => 'Xem trang chính',
    
    /*------------ Sidebar ------------------- */
    'sidebar' => [
        'products' => [
            'title' => 'Quản lý sản phẩm',
            'products' => 'Danh mục sản phẩm',
            'categories' => 'Danh mục loại sản phẩm',
            'vendors' => 'Danh mục nhà cung cấp',
        ],
        'orders' => 'Quản lý đơn hàng',
        'banners' => 'Quản lý banner',
        'posts' => 'Quản lý bài viết',
        'pages' => [
            'title' => 'Quản lý trang nội dung',
            'pages_about' => 'Giới thiệu',
        ],
        'contacts' => 'Hộp thư liên hệ',
        'users' => 'Quản lý tài khoản',
        'forum' => [
            'title' => 'Diễn đàn',
            'members' => 'Thành viên',
            'groups' => 'Nhóm thảo luận',
            'threads' => 'Chủ đề thảo luận',
            'comments' => 'Bình luận'
        ],
        'config_edit' => 'Cài đặt',
    ],
    'banner_type' => $bannerType,
    /*------------ Vendor page ------------------- */
    'vendors' => [
        'list_title' => 'Danh mục nhà cung cấp',
        'create_title' => 'Đăng ký nhà cung cấp',
        'edit_title' => 'Chỉnh sửa nhà cung cấp',
        'edit_title' => 'Chỉnh sửa nhà cung cấp',
        'search_placeholder' => 'Mã, tên nhà cung cấp',
        'table_header' => [
            'id' => 'ID',
            'name' => 'Tên nhà cung cấp',
            'logo' => 'Logo',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày đăng ký',
            'updated_at' => 'Ngày chỉnh sửa'
        ],
        'search_form' => [
            'id' => ['type' => 'text', 'placeholder' => 'Lọc theo ID nhà cung cấp'],
            'name' => ['type' => 'text', 'placeholder' => 'Lọc theo tên nhà cung cấp'],
            'status' => ['type' => 'status_select']
        ],
        'search_form' => [
            'id' => ['type' => 'text', 'placeholder' => 'Lọc theo ID loại sản phẩm'],
            'name' => ['type' => 'text', 'placeholder' => 'Lọc theo tên loại sản phẩm'],
            'status' => ['type' => 'status_select']
        ],
        'form' => [
            'name' => ['type' => 'text', 'text' => 'Tên nhà cung cấp'],
            'description' => ['type' => 'textarea', 'text' => 'Mô tả'],
            'logo' => [
                'type' => 'file',
                'text' => 'Hình ảnh',
            ],
            'status' => ['type' => 'checkbox', 'text' => 'Đang hoạt động']
        ]
    ],
    /*------------ Category page ------------------- */
    'categories' => [
        'list_title' => 'Danh mục loại sản phẩm',
        'create_title' => 'Đăng ký loại sản phẩm',
        'edit_title' => 'Chỉnh sửa loại sản phẩm',
        'edit_title' => 'Chỉnh sửa loại sản phẩm',
        'search_placeholder' => 'Mã, tên loại sản phẩm',
        'table_header' => [
            'id' => 'ID',
            'name' => 'Tên loại sản phẩm',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày đăng ký',
            'updated_at' => 'Ngày chỉnh sửa'
        ],
        'search_form' => [
            'id' => ['type' => 'text', 'placeholder' => 'Lọc theo ID loại sản phẩm'],
            'name' => ['type' => 'text', 'placeholder' => 'Lọc theo tên loại sản phẩm'],
            'status' => ['type' => 'status_select']
        ],
        'form' => [
            'name' => ['type' => 'text', 'text' => 'Tên loại sản phẩm'],
            'parent_id' => [
                'type' => 'select', 
                'text' => 'Chọn loại cha', 
                'empty_text' => '(Không chọn mặc định đây là loại cha)',
                'table' => \App\Constants\Common::CATEGORIES
            ],
            'status' => ['type' => 'checkbox', 'text' => 'Đang hoạt động']
        ]
    ],
    /*------------ Banner page ------------------- */
    'banners' => [
        'list_title' => 'Danh mục banner',
        'create_title' => 'Đăng ký banner',
        'edit_title' => 'Chỉnh sửa banner',
        'table_header' => [
            'id' => 'ID',
            'banner' => 'Banner',
            'link' => 'Đường dẫn',
            'description' => 'Mô tả',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày đăng ký',
            'updated_at' => 'Ngày chỉnh sửa'
        ],
        'search_form' => [
            'status' => ['type' => 'status_select', 'empty_text' => 'Lọc theo trạng thái'],
            'select_type' => ['type' => 'data_select', 'table' => 'BANNER_TYPE', 'empty_text' => 'Lọc theo loại'],
        ],
        'status' => 'Tất cả trạng thái',
        'form' => [
            'select_type' => [
                'type' => 'radio_list', 
                'value' => $bannerType
            ],
            'banner' => [
                'type' => 'file',
                'text' => 'Banner',
                'container_id' => 'use_image'
            ],
            'link' => ['type' => 'text', 'text' => 'Đường dẫn', 'container_id' => 'use_image'],
            'youtube_id' => ['type' => 'text', 'text' => 'Youtube URL', 'container_id' => 'use_youtube'],
            'preview_youtube' => ['type' => 'youtube_preview', 'text' => 'Preview', 'container_id' => 'use_youtube'],
            'status' => ['type' => 'checkbox', 'text' => 'Đang hoạt động'],
        ]
    ],
    /*------------ Contacts page ------------------- */
    'contacts' => [
        'list_title' => 'Danh mục liên hệ',
        'edit_title' => 'Xem thư',
        'table_header' => [
            'id' => 'ID',
            'subject' => 'Tựa đề',
            'email' => 'E-mail',
            'phone' => 'Số điện thoại',
            'content' => 'Nội dung',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày gửi',
        ],
        'search_form' => [
            'email' => ['type' => 'text', 'placeholder' => 'Lọc theo địa chỉ E-mail'],
            'phone' => ['type' => 'text', 'placeholder' => 'Lọc theo số điện thoại'],
            'status' => ['type' => 'data_select', 'empty_text' => 'Lọc theo trạng thái', 'table' => 'CONTACT_TYPE'],
        ],
        'form' => [
            'subject' => ['type' => 'text', 'text' => 'Tựa đề', 'disabled' => true],
            'name' => ['type' => 'text', 'text' => 'Tên', 'disabled' => true],
            'email' => ['type' => 'link', 'text' => 'E-mail', 'disabled' => true],
            'phone' => ['type' => 'text', 'text' => 'Số điện thoại', 'disabled' => true],
            'content' => ['type' => 'textarea', 'text' => 'Nội dung', 'disabled' => true],
            'reply_content' => ['type' => 'editor', 'text' => 'Nội dung trả lời '],
        ],
    ],
    /*------------ Posts page ------------------- */
    'posts' => [
        'list_title' => 'Danh mục bài viết',
        'create_title' => 'Đăng ký bài viết',
        'edit_title' => 'Chỉnh sửa bài viết',
        'table_header' => [
            'id' => 'ID',
            'name' => 'Tựa đề',
            'photo' => 'Hình ảnh',
            'description' => 'Mô tả ngắn',
            'status' => 'Trạng thái',
            'published_at' => 'Ngày xuất bản',
            'created_at' => 'Ngày đăng ký',
        ],
        'id_placeholder' => 'Lọc theo Id bài viết',
        'name_placeholder' => 'Lọc theo tựa đề',
        'status' => 'Tất cả trạng thái',
        'search_form' => [
            'id' => ['type' => 'text', 'placeholder' => 'Lọc theo ID bài viết'],
            'name' => ['type' => 'text', 'placeholder' => 'Lọc theo tựa đề'],
            'status' => ['type' => 'status_select', 'empty_text' => 'Lọc theo trạng thái'],
        ],
        'form' => [
            'name' => [
                'type' => 'text', 'text' => 'Tựa đề', 'maxlength' => 100
            ],
            'photo' => [
                'type' => 'file',
                'text' => 'Hình ảnh',
            ],
            'description' => [
                'type' => 'textarea', 'text' => 'Mô tả ngắn', 'maxlength' => 200
            ],
            'content' => ['type' => 'editor', 'text' => 'Nội dung'],
            'status' => ['type' => 'checkbox', 'text' => 'Xuất bản'],
        ],
    ],
    'about' => [
        'edit_title' => 'Giới thiệu',
        'form' => [
            'content' => ['type' => 'editor', 'text' => 'Nội dung'],
        ]
    ],
    'delivery' => [
        'edit_title' => 'Phương thức giao hàng',
        'form' => [
            'content' => ['type' => 'editor', 'text' => 'Nội dung'],
        ],
    ],
    /*------------ Orders page ------------------- */
    'orders' => [
        'list_title' => 'Danh mục đơn hàng',
        'edit_title' => 'Cập nhật đơn hàng',
        'table_header' => [
            'id' => 'ID',
            'name' => 'Tên khách hàng',
            'email' => 'E-mail',
            'address' => 'Địa chỉ',
            'phone' => 'Điện thoại',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày đặt hàng',
            'images' => 'Hình ảnh',
            'products' => 'Sản phẩm',
            'qty' => 'Số lượng',
            'price' => 'Đơn giá',
            'cost' => 'Thành tiền'
        ],
        'search_form' => [
            'id' => ['type' => 'text', 'placeholder' => 'Lọc theo ID bài viết'],
            'name' => ['type' => 'text', 'placeholder' => 'Lọc theo tên khách hàng'],
            'phone' => ['type' => 'text', 'placeholder' => 'Lọc theo số điện thoại'],
            'date' => ['type' => 'text', 'placeholder' => 'Lọc theo ngày giao hàng'],
            'status' => ['type' => 'data_select', 'table' => 'STATUS_ORDERS', 'empty_text' => 'Lọc theo trạng thái'],
        ],
        'form' => [
            'customer_info' => [
                'header' => 'Thông tin khách hàng',
                'customer_name' => ['type' => 'label', 'text' => 'Tên khách hàng: '],
                'customer_email' => ['type' => 'label', 'text' => 'E-mail: '],
                'customer_address' => ['type' => 'label', 'text' => 'Địa chỉ giao hàng: '],
                'customer_phone' => ['type' => 'label', 'text' => 'Số điện thoại: '],
                'payment_method' => ['type' => 'label', 'text' => 'Phương thức chi trả: '],
                'status' => ['type' => 'select', 'table' => 'STATUS_ORDERS', 'text' => 'Trạng thái đơn hàng', 'empty_text']
            ],
         ]
    ],
    /*------------ Config page ------------------- */
    'config' => [
        'edit_title' => 'Cài đặt hệ thống',
        'form' => [
            'web_info' => [
                'header' => 'Website informations',
                'web_title' => ['type' => 'text', 'text' => 'Web name'],
                'web_logo' => [
                    'type' => 'file', 
                    'text' => 'Web logo',
                ],
                'web_ico' => [
                    'type' => 'file',
                    'text' => 'Web ico',
                    'file_ext' => \App\Constants\Common::ICO_EXT
                ],
                'web_email' => ['type' => 'text', 'text' => 'Web mail'],
                'web_description' => ['type' => 'textarea', 'text' => 'SEO Description'],
                'web_keywords' => ['type' => 'textarea', 'text' => 'SEO Keywords'],
            ],
            'mail_settings' => [
                'header' => 'Mail settings',
                'mail_driver' => ['type' => 'text', 'text' => 'Mail driver'],
                'mail_host' => ['type' => 'text', 'text' => 'Mail host'],
                'mail_port' => ['type' => 'text', 'text' => 'Mail port'],
                'mail_from' => ['type' => 'text', 'text' => 'Mail from'],
                'mail_name' => ['type' => 'text', 'text' => 'Mail name'],
                'mail_encryption' => ['type' => 'text', 'text' => 'Mail encryption'],
                'mail_account' => ['type' => 'text', 'text' => 'Mail account'],
                'mail_password' => ['type' => 'text', 'text' => 'Mail password'],
            ],
            'upload_settings' => [
                'header' => 'Upload settings',
                'banners_maximum_upload' => ['type' => 'select', 'text' => 'Maximum upload file (Banner) KB', 'table' => 'UPLOAD_SIZE_LIMIT'],
                'vendors_maximum_upload' => ['type' => 'select', 'text' => 'Maximum upload file (Nhà cung cấp) KB', 'table' => 'UPLOAD_SIZE_LIMIT'],
                'products_maximum_upload' => ['type' => 'select', 'text' => 'Maximum upload file (Sản phẩm) KB', 'table' => 'UPLOAD_SIZE_LIMIT'],
                'posts_maximum_upload' => ['type' => 'select', 'text' => 'Maximum upload file (Bài viết) KB', 'table' => 'UPLOAD_SIZE_LIMIT'],
                'web_logo_maximum_upload' => ['type' => 'select', 'text' => 'Maximum upload file (Web logo) KB', 'table' => 'UPLOAD_SIZE_LIMIT'],
                'web_ico_maximum_upload' => ['type' => 'select', 'text' => 'Maximum upload file (Web ico) KB', 'table' => 'UPLOAD_SIZE_LIMIT'],
                'attachment_maximum_upload' => ['type' => 'select', 'text' => 'Maximum upload file (Đính kèm) KB', 'table' => 'UPLOAD_SIZE_LIMIT'],
                'users_maximum_upload' => ['type' => 'select', 'text' => 'Maximum upload file (Ảnh đại diện) KB', 'table' => 'UPLOAD_SIZE_LIMIT'],
                'banners_image_size' => ['type' => 'text', 'text' => 'Kích thước banner (dài x rộng)'],
                'vendors_image_size' => ['type' => 'text', 'text' => 'Kích thước logo nhà cung cấp (dài x rộng)'],
                'products_image_size' => ['type' => 'text', 'text' => 'Kích thước hình sản phẩm (dài x rộng)'],
                'posts_image_size' => ['type' => 'text', 'text' => 'Kích thước hình bài viết (dài x rộng)'],
                'web_logo_image_size' => ['type' => 'text', 'text' => 'Kích thước web logo (dài x rộng)'],
                'web_ico_image_size' => ['type' => 'text', 'text' => 'Kích thước web icon (dài x rộng)'],
                'users_image_size' => ['type' => 'text', 'text' => 'Kích thước ảnh đại diện (dài x rộng)'],
            ],
            'payment_method' => [
                'header' => 'Phương thức thanh toán',
                'bank_info' => ['type' => 'editor', 'text' => 'Chuyển khoản ngân hàng'],
                'cash_info' => ['type' => 'editor', 'text' => 'Tiền mặt'],
            ],
            'url_ext' => [
                'url_ext' => ['type' => 'text', 'text' => 'URL Extension'],
            ],
            'off' => [
                'off' => ['type' => 'checkbox', 'text' => 'Tắt hệ thống']
            ],
            
        ],
    ],
    /*------------ Products page ------------------- */
    'products' => [
        'list_title' => 'Danh mục sản phẩm',
        'create_title' => 'Đăng ký sản phẩm',
        'edit_title' => 'Chỉnh sửa sản phẩm',
        'table_header' => [
            'id' => 'ID',
            'name' => 'Tên sản phẩm',
            'image' => 'Hình ảnh',
            'category' => 'Loại SP',
            'vendor' => 'Nhà cung cấp',
            'price' => 'Giá bán (VNĐ)',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày đăng ký',
        ],
        'search_form' => [
            'id' => ['type' => 'text', 'placeholder' => 'Lọc theo Id sản phẩm'],
            'name' => ['type' => 'text', 'placeholder' => 'Lọc theo tên sản phẩm'],
            'status' => ['type' => 'status_select', 'empty_text' => 'Lọc theo trạng thái'],
            'category_id' => ['type' => 'data_select', 'table' => \App\Constants\Common::CATEGORIES, 'empty_text' => 'Lọc theo loại'],
            'vendor_id' => ['type' => 'data_select', 'table' => \App\Constants\Common::VENDORS, 'empty_text' => 'Lọc theo nhà cung cấp'],
        ],
        'form' => [
            'name' => ['type' => 'text', 'text' => 'Tên sản phẩm'],
            'price' => ['type' => 'currency', 'text' => 'Giá bán', 'maxlength' => 10],
            'discount' => ['type' => 'number', 'text' => 'Tỷ lệ giảm giá (%)', 'value' => 0, 'maxlength' => 3],
            'category_id' => [
                'type' => 'select',
                'text' => 'Loại sản phẩm',
                'empty_text' => 'Chọn loại sản phẩm',
                'table' => \App\Constants\Common::CATEGORIES
            ],
            'vendor_id' => [
                'type' => 'select',
                'text' => 'Nhà cung cấp',
                'empty_text' => 'Chọn nhà cung cấp',
                'table' => \App\Constants\Common::VENDORS
            ],
            'sizes' => ['type' => 'checkbox_multi', 'text' => 'Kích cỡ', 'table' => \App\Constants\Common::SIZES],
            'colors' => ['type' => 'checkbox_color_multi', 'text' => 'Màu sắc', 'table' => \App\Constants\Common::COLORS],
            'image' => [
                'type' => 'file',
                'text' => 'Hình sản phẩm',
                'size' => \App\Constants\Common::IMAGE_MAX_SIZE,
                'width' => \App\Constants\Common::IMAGE_WIDTH,
                'height' => \App\Constants\Common::IMAGE_HEIGHT,
                'count' => 5
            ],
            'description' => ['type' => 'editor', 'text' => 'Chi tiết'],
            'status' => ['type' => 'checkbox', 'text' => 'Đang hoạt động', 'checked' => true],
            'is_new' => ['type' => 'checkbox', 'text' => 'Sản phẩm mới', 'checked' => true],
            'is_popular' => ['type' => 'checkbox', 'text' => 'Sản phẩm được quan tâm', 'checked' => true],
            'is_best_selling' => ['type' => 'checkbox', 'text' => 'Sản phẩm bán chạy', 'checked' => true],
        ]
    ],
    'accessories' => [
        'list_title' => 'Danh mục phụ kiện',
        'create_title' => 'Đăng ký phụ kiện',
        'edit_title' => 'Chỉnh sửa phụ kiện',
        'table_header' => [
            'id' => 'ID',
            'name' => 'Tên sản phẩm',
            'image' => 'Hình ảnh',
            'category' => 'Loại SP',
            'vendor' => 'Nhà cung cấp',
            'price' => 'Giá bán (VNĐ)',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày đăng ký',
        ],
        'search_form' => [
            'id' => ['type' => 'text', 'placeholder' => 'Lọc theo Id sản phẩm'],
            'name' => ['type' => 'text', 'placeholder' => 'Lọc theo tên sản phẩm'],
            'status' => ['type' => 'status_select', 'empty_text' => 'Lọc theo trạng thái'],
            'category_id' => ['type' => 'data_select', 'table' => \App\Constants\Common::CATEGORIES, 'empty_text' => 'Lọc theo loại'],
            'vendor_id' => ['type' => 'data_select', 'table' => \App\Constants\Common::VENDORS, 'empty_text' => 'Lọc theo nhà cung cấp'],
        ],
        'form' => [
            'name' => ['type' => 'text', 'text' => 'Tên gọi'],
            'price' => ['type' => 'currency', 'text' => 'Giá bán', 'maxlength' => 10],
            'discount' => ['type' => 'number', 'text' => 'Tỷ lệ giảm giá (%)', 'value' => 0, 'maxlength' => 3],
            'category_id' => [
                'type' => 'select',
                'text' => 'Loại sản phẩm',
                'empty_text' => 'Chọn loại sản phẩm',
                'table' => \App\Constants\Common::CATEGORIES
            ],
            'vendor_id' => [
                'type' => 'select',
                'text' => 'Nhà cung cấp',
                'empty_text' => 'Chọn nhà cung cấp',
                'table' => \App\Constants\Common::VENDORS
            ],
            'sizes' => ['type' => 'checkbox_multi', 'text' => 'Kích cỡ', 'table' => \App\Constants\Common::SIZES],
            'colors' => ['type' => 'checkbox_color_multi', 'text' => 'Màu sắc', 'table' => \App\Constants\Common::COLORS],
            'image' => [
                'type' => 'file',
                'text' => 'Hình sản phẩm',
                'size' => \App\Constants\Common::IMAGE_MAX_SIZE,
                'width' => \App\Constants\Common::IMAGE_WIDTH,
                'height' => \App\Constants\Common::IMAGE_HEIGHT,
                'count' => 5
            ],
            'description' => ['type' => 'editor', 'text' => 'Chi tiết'],
            'status' => ['type' => 'checkbox', 'text' => 'Đang hoạt động', 'checked' => true],
            'is_new' => ['type' => 'checkbox', 'text' => 'Sản phẩm mới', 'checked' => true],
            'is_popular' => ['type' => 'checkbox', 'text' => 'Sản phẩm được quan tâm', 'checked' => true],
            'is_best_selling' => ['type' => 'checkbox', 'text' => 'Sản phẩm bán chạy', 'checked' => true],
        ]
    ],
    /*------------ Sizes page ------------------- */
    'sizes' => [
        'list_title' => 'Danh mục kích cỡ',
        'edit_create_title' => 'Đăng ký / Chỉnh sửa',
        'table_header' => [
            'id' => 'ID',
            'name' => 'Tên gọi',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày đăng ký',
            'updated_at' => 'Ngày chỉnh sửa'
        ],
        'form' => [
            'name' => ['type' => 'text', 'text' => 'Tên gọi'],
            'status' => ['type' => 'checkbox', 'text' => 'Đang hoạt động'],
        ]
    ],
    /*------------ Colors page ------------------- */
    'colors' => [
        'list_title' => 'Danh mục màu sắc',
        'edit_create_title' => 'Đăng ký / Chỉnh sửa',
        'table_header' => [
            'id' => 'ID',
            'name' => 'Màu sắc',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày đăng ký',
            'updated_at' => 'Ngày chỉnh sửa'
        ],
        'form' => [
            'name' => ['type' => 'text', 'text' => 'Màu sắc'],
            'status' => ['type' => 'checkbox', 'text' => 'Đang hoạt động'],
        ]
    ],
    /*------------ Users page ------------------- */
    'users' => [
        'list_title' => 'Danh mục tài khoản',
        'create_title' => 'Đăng ký tài khoản',
        'edit_title' => 'Chỉnh sửa tài khoản',
        'table_header' => [
            'id' => 'ID',
            'name' => 'Tên',
            'avatar' => 'Hình ảnh',
            'email' => 'E-mail',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày đăng ký',
        ],
        'search_form' => [
            'id' => ['type' => 'text', 'placeholder' => 'Lọc theo ID tài khoản'],
            'name' => ['type' => 'text', 'placeholder' => 'Lọc theo tên'],
            'phone' => ['type' => 'text', 'placeholder' => 'Lọc theo số điện thoại'],
            'email' => ['type' => 'text', 'placeholder' => 'Lọc theo địa chỉ e-mail'],
            'status' => ['type' => 'status_select', 'empty_text' => 'Lọc theo trạng thái'],
        ],
        'form' => [
            'name' => ['type' => 'text', 'text' => 'Tên tài khoản'],
            'avatar' => [
                'type' => 'file',
                'text' => 'Ảnh đại diện',
                'size' => \App\Constants\Common::AVATAR_MAX_SIZE,
                'width' => \App\Constants\Common::AVATAR_WIDTH,
                'height' => \App\Constants\Common::AVATAR_HEIGHT
            ],
            'email' => ['type' => 'email', 'text' => 'E-mail'],
            'password' => ['type' => 'password', 'text' => 'Mật khẩu'],
            'conf_password' => ['type' => 'password', 'text' => 'Xác nhận mật khẩu'],
            'status' => ['type' => 'checkbox', 'text' => 'Đang hoạt động'],
        ]
    ],
    /*------------ Profile page ------------------- */
    'profile' => [
        'edit_title' => 'Chỉnh sửa tài khoản',
        'form' => [
            'name' => ['type' => 'text', 'text' => 'Tên tài khoản'],
            'avatar' => [
                'type' => 'file',
                'text' => 'Ảnh đại diện',
                'size' => \App\Constants\Common::AVATAR_MAX_SIZE,
                'width' => \App\Constants\Common::AVATAR_WIDTH,
                'height' => \App\Constants\Common::AVATAR_HEIGHT
            ],
            'password' => ['type' => 'password', 'text' => 'Mật khẩu'],
            'conf_password' => ['type' => 'password', 'text' => 'Xác nhận mật khẩu'],
        ]
    ],
    /*------------ Threads page ------------------- */
    'threads' => [
        'list_title' => 'Danh mục chủ đề',
        'create_title' => 'Đăng ký chủ đề',
        'edit_title' => 'Chỉnh sửa chủ đề',
        'edit_title' => 'Chỉnh sửa chủ đề',
        'search_placeholder' => 'Mã, tên chủ đề',
        'table_header' => [
            'id' => 'ID',
            'name' => 'Tên chủ đề',
            'status' => 'Trạng thái',
            'author' => 'Người đăng',
            'created_at' => 'Ngày đăng ký',
            'updated_at' => 'Ngày chỉnh sửa'
        ],
        'id_placeholder' => 'Lọc theo Id chủ đề',
        'name_placeholder' => 'Lọc theo tên chủ đề',
        'status' => 'Tất cả trạng thái',
        'form' => [
            'name' => ['type' => 'text', 'text' => 'Chủ đề'],
            'content' => [
                'type' => 'editor',
                'text' => 'Nội dung',
            ],
            'status' => ['type' => 'checkbox', 'text' => 'Đang hoạt động']
        ]
    ],
    /*------------ Members page ------------------- */
    'pages' => [
        'create_title' => 'Đăng ký',
        'edit_title' => 'Chỉnh sửa',
        'form' => [
            'content' => ['type' => 'editor', 'text' => 'Nội dung']
        ]
    ],
    /*------------ Members page ------------------- */
    'members' => [
        'list_title' => 'Danh mục thành viên',
        'create_title' => 'Đăng ký thành viên',
        'edit_title' => 'Chỉnh sửa thành viên',
        'edit_title' => 'Chỉnh sửa thành viên',
        'search_placeholder' => 'Mã, tên thành viên',
        'table_header' => [
            'id' => 'ID',
            'name' => 'Tên',
            'email' => 'E-mail',
            'avatar' => 'Ảnh đại diện',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày đăng ký',
            'updated_at' => 'Ngày chỉnh sửa'
        ],
        'search_form' => [
            'id' => ['type' => 'text', 'placeholder' => 'Lọc theo Id thành viên'],
            'name' => ['type' => 'text', 'placeholder' => 'Lọc theo tên thành viên'],
            'status' => ['type' => 'status_select']
        ],
        'form' => [
            'name' => ['type' => 'text', 'text' => 'Tên thành viên'],
            'email' => ['type' => 'email', 'text' => 'E-mail'],
            'password' => ['type' => 'password', 'text' => 'Mật khẩu'],
            'conf_password' => ['type' => 'password', 'text' => 'Xác nhận mật khẩu'],
            'avatar' => [
                'type' => 'file',
                'text' => 'Ảnh đại diện',
                'size' => \App\Constants\Common::AVATAR_MAX_SIZE,
                'width' => \App\Constants\Common::AVATAR_WIDTH,
                'height' => \App\Constants\Common::AVATAR_HEIGHT
            ],
            'status' => ['type' => 'checkbox', 'text' => 'Đang hoạt động']
        ]
    ],
    'product_type' => $productType,
    'text_image_small' => 'Tập tin *.jpg, *.jpeg, *.gif, *.png.Tối đa {0}',
    'select_empty_text' => 'Vui lòng chọn',
    'price_empty_text' => 'Liên hệ',
    'preview_image' => 'Hình đang sử dụng:',
    'no_data_found' => '(Chưa có dữ liệu)',
    'create_box_title' => 'Thông tin đăng ký',
    'edit_box_title' => 'Thông tin cập nhật',
    'length_text' => ' (Tối đã {0} ký tự)',
    'product_info' => 'Thông tin sản phẩm',
    'services' => 'Thông tin thêm',
    'status' => [
        'unactive' => 'Tạm dừng',
        'active' => 'Đang hoạt động',
        'new' => 'Thư mới',
        'replied' => 'Đã trả lời',
        'published' => 'Đã xuất bản',
        'not_published' => 'Chưa xuất bản',
        'order_new' => 'Đơn hàng mới',
        'order_shipping' => 'Đang giao hàng',
        'order_done' => 'Hoàn tất'
    ],
    'role' => [
        'super_admin' => 'Quản trị hệ thống',
        'admin' => 'Quản trị viên',
        'member' => 'Thành viên'
    ],
    'button' => [
        'login' => 'Đăng nhập',
        'profile' => 'Thông tin tài khoản',
        'logout' => 'Thoát',
        'create' => 'Đăng ký',
        'search' => 'Tìm kiếm',
        'submit' => 'Lưu',
        'back' => 'Quay về',
        'send' => 'Gửi',
        'remove' => 'Xóa',
        'add_image' => 'Tải file',
        'upload_image' => 'Chọn file',
        'close' => 'Đóng',
        'select' => 'Chọn',
        'remove_all_data' => 'Xóa toàn bộ dữ liệu',
        'clear_config_cache' => 'Xóa cache',
        'add_service' => 'Đăng ký thông tin',
        'add_item' => 'Thêm',
        'copy_service' => 'Sử dụng dịch vụ của sản phẩm khác'
    ]
];

return $auth;
