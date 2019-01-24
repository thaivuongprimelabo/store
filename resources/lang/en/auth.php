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
        'news' => 'Quản lý bài viết',
        'contacts' => 'Hộp thư liên hệ',
        'config' => 'Cấu hình'
    ],
    
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
            'description' => 'Mô tả',
            'logo' => 'Tải logo',
            'logo_text' => 'Tập tin *.jpg, *.jpeg, *.gif, *.png.Tối đa {0}'
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
        'parent_empty_text' => 'Chọn loại cha (Không chọn mặc định đây là loại cha)',
        'form' => [
            'name' => 'Tên loại sản phẩm',
            'parent' => 'Chọn loại cha',
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
            'banner' => 'Tải banner',
            'link' => 'Đường dẫn',
            'description' => 'Mô tả',
            'banner_text' => 'Tập tin *.jpg, *.jpeg, *.gif, *.png.Tối đa {0}'
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
            'reply' => 'Nội dung trả lời',
            'status' => 'Trạng thái',
            'attachment' => 'Đính kèm',
            'attachment_text' => 'Tập tin *.jpg, *.jpeg, *.gif, *.png, *.pdf, *.doc, *.docx, *.xlsx, *.xls.Tối đa {0}'
        ],
    ],
    'no_data_found' => '(Chưa có dữ liệu)',
    'create_box_title' => 'Thông tin đăng ký',
    'edit_box_title' => 'Thông tin cập nhật',
    'status' => [
        'unactive' => 'Tạm dừng',
        'active' => 'Đang hoạt động',
        'new' => 'Thư mới',
        'replied' => 'Đã trả lời'
    ],
    'button' => [
        'login' => 'Đăng nhập',
        'profile' => 'Thông tin tài khoản',
        'logout' => 'Thoát',
        'create' => 'Đăng ký',
        'search' => 'Tìm kiếm',
        'submit' => 'Lưu',
        'back' => 'Quay về',
        'send' => 'Gửi'
    ]
];
