<?php

namespace App\Constants;

class Status {
    
    CONST UNACTIVE = 0;
    CONST ACTIVE = 1;
    
    public static function getData() {
        return [
            self::UNACTIVE => trans('auth.status.unactive'),
            self::ACTIVE => trans('auth.status.active')
        ];
    }
}