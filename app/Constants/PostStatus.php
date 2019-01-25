<?php

namespace App\Constants;

class PostStatus {
    
    CONST NOT_PUBLISHED = 0;
    CONST PUBLISHED = 1;
    
    public static function getData($key = '') {
        $array = [
            self::NOT_PUBLISHED => trans('auth.status.not_published'),
            self::PUBLISHED => trans('auth.status.published'),
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