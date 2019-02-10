<?php

namespace App\Constants;

class Status {
    
    CONST UNACTIVE = 0;
    CONST ACTIVE = 1;
    CONST IS_NEW = 1;
    CONST IS_POPULAR = 1;
    CONST IS_BEST_SELLING = 1;
    CONST ORDER_NEW = 0;
    CONST ORDER_SHIPPING = 1;
    CONST ORDER_DONE = 2;
    
    public static function getData($key = '', $type = 0) {
        $array = [
            self::UNACTIVE => trans('auth.status.unactive'),
            self::ACTIVE => trans('auth.status.active'),
        ];
        
        if($type == 1) {
            $array = [
                self::ORDER_NEW => trans('auth.status.order_new'),
                self::ORDER_SHIPPING => trans('auth.status.order_shipping'),
                self::ORDER_DONE => trans('auth.status.order_done'),
            ];
        }

        if($key != '') {
            return $array[$key];
        }
        
        return $array;
    }
    
    public static function createSelectList($type = 0, $selected = '9999') {
        $data = self::getData('', $type);
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