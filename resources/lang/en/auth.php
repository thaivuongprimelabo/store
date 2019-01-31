<?php

return [

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
    
    /*------------ Sidebar ------------------- */
    'sidebar' => [
        'products' => 'Quản lý sản phẩm',
        'categories' => 'Quản lý loại sản phẩm',
        'vendors' => 'Quản lý nhà cung cấp',
        'banners' => 'Quản lý banner',
        'posts' => 'Quản lý bài viết',
        'contacts' => 'Hộp thư liên hệ',
        'users' => 'Quản lý tài khoản',
        'config_edit' => 'Cấu hình'
    ],
    'sidebar_node' => ['Danh sách', 'Đăng ký'],
    
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
        'id_search_placeholder' => 'Lọc theo Id nhà cung cấp',
        'name_search_placeholder' => 'Lọc theo tên nhà cung cấp',
        'status_search' => 'Tất cả trạng thái',
        'form' => [
            'name' => 'Tên nhà cung cấp',
            'description' => ['type' => 'textarea', 'text' => 'Mô tả'],
            'logo' => [
                'type' => 'file',
                'text' => 'Hình ảnh',
                'size' => \App\Constants\Common::LOGO_MAX_SIZE,
                'width' => \App\Constants\Common::LOGO_WIDTH,
                'height' => \App\Constants\Common::LOGO_HEIGHT
            ],
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
        'id_search_placeholder' => 'Lọc theo Id loại sản phẩm',
        'name_search_placeholder' => 'Lọc theo tên loại sản phẩm',
        'status_search' => 'Tất cả trạng thái',
        'form' => [
            'name' => 'Tên loại sản phẩm',
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
        'status_search' => 'Tất cả trạng thái',
        'form' => [
            'banner' => [
                'type' => 'file', 
                'text' => 'Banner',
//                 'size' => \App\Constants\Common::BANNER_MAX_SIZE,
//                 'width' => \App\Constants\Common::BANNER_WIDTH,
//                 'height' => \App\Constants\Common::BANNER_HEIGHT
            ],
            'link' => 'Đường dẫn',
            'description' => ['type' => 'textarea', 'text' => 'Mô tả'],
        ]
    ],
    /*------------ Contacts page ------------------- */
    'contacts' => [
        'list_title' => 'Danh mục liên hệ',
        'edit_title' => 'Trả lời',
        'table_header' => [
            'id' => 'ID',
            'name' => 'Tên',
            'email' => 'E-mail',
            'phone' => 'Số điện thoại',
            'content' => 'Nội dung',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày gửi',
        ],
        'email_search_placeholder' => 'Lọc theo email',
        'phone_search_placeholder' => 'Lọc theo số điện thoại',
        'status_search' => 'Tất cả trạng thái',
        'form' => [
            'name' => 'Tên',
            'email' => 'E-mail',
            'phone' => 'Số điện thoại',
            'content' => 'Nội dung',
            'reply' => ['type' => 'editor', 'text' => 'Nội dung trả lời'],
            'status' => ['type' => 'checkbox', 'text' => 'Đang hoạt động'],
            'attachment' => [
                'type' => 'file',
                'text' => 'Đính kèm',
                'size' => \App\Constants\Common::ATTACHMENT_MAX_SIZE,
                'width' => \App\Constants\Common::ATTACHMENT_WIDTH,
                'height' => \App\Constants\Common::ATTACHMENT_HEIGHT,
                'note_text' => 'Tập tin *.jpg, *.jpeg, *.gif, *.png, *.pdf, *.doc, *.docx, *.xlsx, *.xls.Tối đa {0}'
            ]
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
        'id_search_placeholder' => 'Lọc theo Id bài viết',
        'name_search_placeholder' => 'Lọc theo tựa đề',
        'status_search' => 'Tất cả trạng thái',
        'form' => [
            'name' => 'Tựa đề',
            'photo' => [
                'type' => 'file',
                'text' => 'Hình ảnh',
                'size' => \App\Constants\Common::PHOTO_MAX_SIZE,
                'width' => \App\Constants\Common::PHOTO_WIDTH,
                'height' => \App\Constants\Common::PHOTO_HEIGHT
            ],
            'description' => ['type' => 'textarea', 'text' => 'Mô tả ngắn'],
            'content' => ['type' => 'editor', 'text' => 'Nội dung'],
            'status' => ['type' => 'checkbox', 'text' => 'Xuất bản'],
            'published_at' => ['type' => 'datepicker', 'text' => 'Ngày xuất bản'],
            'published_time_at' => ['type' => 'timepicker', 'text' => 'Thời điểm xuất bản'],
        ],
    ],
    /*------------ Posts page ------------------- */
    'config' => [
        'title' => 'Cấu hình hệ thống',
        'form' => [
            'web_title' => 'Web name',
            'web_logo' => [
                'type' => 'file', 
                'text' => 'Web logo',
                'size' => \App\Constants\Common::WEB_LOGO_MAX_SIZE,
                'width' => \App\Constants\Common::WEB_LOGO_WIDTH,
                'height' => \App\Constants\Common::WEB_LOGO_HEIGHT
            ],
            'web_email' => 'Web mail',
            'web_description' => ['type' => 'textarea', 'text' => 'SEO Description'],
            'web_keywords' => 'SEO Keywords',
            'mail_driver' => 'Mail driver',
            'mail_host' => 'Mail host',
            'mail_port' => 'Mail port',
            'mail_from' => 'Mail from',
            'mail_name' => 'Mail name',
            'mail_encryption' => 'Mail encryption',
            'mail_account' => 'Mail account',
            'mail_password' => 'Mail password',
            'banner_maximum_upload' => 'Maximum upload file (Banner) KB',
            'vendor_maximum_upload' => 'Maximum upload file (Nhà cung cấp) KB',
            'product_maximum_upload' => 'Maximum upload file (Sản phẩm) KB',
            'post_maximum_upload' => 'Maximum upload file (Bài viết) KB',
            'attachment_maximum_upload' => 'Maximum upload file (Đính kèm) KB',
            'banner_image_size' => 'Kích thước banner (dài x rộng)',
            'vendor_image_size' => 'Kích thước logo nhà cung cấp (dài x rộng)',
            'product_image_size' => 'Kích thước hình sản phẩm (dài x rộng)',
            'post_image_size' => 'Kích thước hình bài viết (dài x rộng)',
            'off' => ['type' => 'checkbox', 'text' => 'Tắt hệ thống'],
            
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
        'id_search_placeholder' => 'Id sản phẩm',
        'name_search_placeholder' => 'Tên sản phẩm',
        'status_search' => 'Trạng thái',
        'category_search' => 'Loại SP',
        'vendor_search' => 'Nhà cung cấp',
        'form' => [
            'name' => 'Tên sản phẩm',
            'price' => 'Giá bán',
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
            'description' => ['type' => 'editor', 'text' => 'Mô tả'],
            'image' => [
                'type' => 'file',
                'text' => 'Hình ảnh',
                'size' => \App\Constants\Common::IMAGE_MAX_SIZE,
                'width' => \App\Constants\Common::IMAGE_WIDTH,
                'height' => \App\Constants\Common::IMAGE_HEIGHT
            ],
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
        'id_search_placeholder' => 'Id tài khoản',
        'name_search_placeholder' => 'Tên tài khoản',
        'email_search_placeholder' => 'E-mail',
        'status_search' => 'Trạng thái',
        'form' => [
            'name' => 'Tên tài khoản',
            'avatar' => [
                'type' => 'file',
                'text' => 'Ảnh đại diện',
                'size' => \App\Constants\Common::AVATAR_MAX_SIZE,
                'width' => \App\Constants\Common::AVATAR_WIDTH,
                'height' => \App\Constants\Common::AVATAR_HEIGHT
            ],
            'email' => 'E-mail',
            'password' => ['type' => 'password', 'text' => 'Mật khẩu'],
            'conf_password' => ['type' => 'password', 'text' => 'Xác nhận mật khẩu'],
            'status' => ['type' => 'checkbox', 'text' => 'Đang hoạt động'],
            'role_id' => ['type' => 'select', 'text' => 'Quyền hạn', 'empty_text' => '---', 'table' => ''],
        ]
    ],
    'profile' => [
        'edit_title' => 'Chỉnh sửa tài khoản',
        'form' => [
            'name' => 'Tên tài khoản',
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
    'text_image_small' => 'Tập tin *.jpg, *.jpeg, *.gif, *.png.Tối đa {0}',
    'select_empty_text' => 'Vui lòng chọn',
    'price_empty_text' => 'Liên hệ',
    'preview_image' => 'Hình đang sử dụng:',
    'no_data_found' => '(Chưa có dữ liệu)',
    'create_box_title' => 'Thông tin đăng ký',
    'edit_box_title' => 'Thông tin cập nhật',
    'status' => [
        'unactive' => 'Tạm dừng',
        'active' => 'Đang hoạt động',
        'new' => 'Thư mới',
        'replied' => 'Đã trả lời',
        'published' => 'Đã xuất bản',
        'not_published' => 'Chưa xuất bản',
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
        'add_image' => 'Thêm hình',
        'upload_image' => 'Tải hình'
    ]
];
