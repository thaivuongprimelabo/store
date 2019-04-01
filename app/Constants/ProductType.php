<?php

namespace App\Constants;

class ProductType {
    
    CONST NORMAL = 0;
    CONST ACCESSORIES = 1;
    
    public static function getData($key = '') {
        $array = [
            self::NORMAL => trans('auth.product_type.normal'),
            self::ACCESSORIES => trans('auth.product_type.accessories'),
        ];
        
        if($key != '') {
            return $array[$key];
        }
        
        return $array;
    }
    
    public static function createSelectList($selected = '') {
        $data = self::getData();
        $html = '';
        foreach($data as $key=>$value) {
            if($key == $selected) {
                $html .= '<option value="'. $key.'" selected>'. $value .'</option>';
            } else {
                $html .= '<option value="'. $key.'">'. $value .'</option>';
            }
        }
        return $html;
    }
    
}