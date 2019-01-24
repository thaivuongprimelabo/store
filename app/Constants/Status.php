<?php

namespace App\Constants;

class Status {
    
    CONST UNACTIVE = 0;
    CONST ACTIVE = 1;
    CONST NEW_CONTACT = 0;
    CONST REPLIED_CONTACT = 1;
    
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
}