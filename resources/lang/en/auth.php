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
        'product' => 'Quản lý sản phẩm',
        'category' => 'Quản lý loại sản phẩm',
        'vendor' => 'Quản lý nhà cung cấp',
        'banner' => 'Quản lý banner',
        'contact' => 'Hộp thư liên hệ',
        'config' => 'Cấu hình'
    ],
    
    /*------------ Vendor page ------------------- */
    'vendor' => [
        'list_title' => 'Danh mục nhà cung cấp',
        'search_placeholder' => 'Mã, tên nhà cung cấp',
        'table_header' => [
            'id' => 'ID',
            'name' => 'Tên nhà cung cấp',
            'logo' => 'Logo',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày đăng ký',
            'updated_at' => 'Ngày chỉnh sửa'
        ]
    ],
    'status' => [
        'unactive' => 'Tạm dừng',
        'active' => 'Đang hoạt động'
    ],
    'button' => [
        'login' => 'Đăng nhập',
        'profile' => 'Thông tin tài khoản',
        'logout' => 'Thoát'
    ]
];
