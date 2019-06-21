<?php

namespace App\Constants;

use App\Helpers\Utils;

class BookingStatus {
    
    CONST AVAILABLE = 0;
    CONST WAITING_CONFIRM = 1;
    CONST CONFIRMED = 2;
    CONST CANCEL = 3;
    
    public static function getData($key = '') {
        $array = [
            self::CANCEL => trans('auth.status.booking_cancel'),
            self::WAITING_CONFIRM => trans('auth.status.booking_confirm'),
            self::AVAILABLE => trans('auth.status.booking_available'),
            self::CONFIRMED => trans('auth.status.booking_done')
        ];
        
        if($key !== '') {
            return isset($array[$key]) ? $array[$key] : '';
        }
        
        return $array;
    }
    
    public static function getLabel($slot) {
        $label = '';
            
        $cssClass = '';
        $icon = 'fa fa-user';
        switch($slot['status']) {
            
            case self::CANCEL:
                $cssClass = 'label label-danger';
                break;
            
            case self::AVAILABLE:
                $cssClass = 'label label-default';
                break;
            
            case self::WAITING_CONFIRM:
                $cssClass = 'label label-warning';
                break;
                
            case self::CONFIRMED:
                $cssClass = 'label label-success';
                break;
        }
        
        if(!empty($cssClass)) {
            if($slot['id'] != -1) {
                $text = '<i class="' . $icon . '"></i> ' . str_limit($slot['name'], 14);
            } else {
                $icon = 'fa fa-plus';
                $text = '<i class="' . $icon . '"></i> ' . self::getData($slot['status']);
            }
            $label .= '<a href="javascript:void(0)" class="btn-slot" data-slot=\'' . json_encode($slot) . '\'><label class="' . $cssClass . ' booking_label">' . $text . '</label></a>';
        }
       
        return $label;
    }
    
    public static function createSelectList($selected = '') {
        $data = self::getData();
        $html = '';
        foreach($data as $key=>$value) {
            if(!Utils::blank($selected) && $key == $selected) {
                $html .= '<option value="'. $key.'" selected>'. $value .'</option>';
            } else {
                $html .= '<option value="'. $key.'">'. $value .'</option>';
            }
        }
        return $html;
    }
    
}