<?php

namespace App\Constants;

class Status {
    
    CONST UNACTIVE = 0;
    CONST ACTIVE = 1;
    CONST IS_NEW = 1;
    CONST IS_POPULAR = 1;
    CONST IS_BEST_SELLING = 1;
    
    public static function getData($key = '') {
        $array = [
            self::UNACTIVE => trans('auth.status.unactive'),
            self::ACTIVE => trans('auth.status.active'),
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