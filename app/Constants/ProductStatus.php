<?php

namespace App\Constants;

class ProductStatus {
    
    CONST IS_NEW = 1;
    CONST IS_POPULAR = 1;
    CONST IS_BEST_SELLING = 1;
    
    public static function getData($key = '') {
        $array = [
            self::IS_NEW => trans('auth.products.form.is_new.text'),
            self::IS_POPULAR => trans('auth.products.form.is_popular.text'),
            self::IS_BEST_SELLING => trans('auth.products.form.is_best_selling.text'),
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