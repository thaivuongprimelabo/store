<?php

namespace App\Constants;

class UserRole {
    
    CONST SUPER_ADMIN = '0';
    CONST ADMIN = '1';
    CONST MOD = '2';
    CONST MEMBERS = '3';
    
    public static function getData($key = '') {
        $array = [
            self::SUPER_ADMIN => trans('auth.role.super_admin'),
            self::ADMIN => trans('auth.role.admin'),
            self::MOD => trans('auth.role.mod')
        ];

        if($key != '') {
            return $array[$key];
        }
        
        return $array;
    }
    
    public static function createSelectList() {
        $data = self::getData();
        $html = '';
        foreach($data as $key=>$value) {
            $html .= '<option value="'. $key.'">'. $value .'</option>';
        }
        return $html;
    }
    
}