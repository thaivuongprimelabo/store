<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\Helpers\Utils;

class ApiController extends Controller
{
    //
    public function checkExists(Request $request) {
        $value = trim($request->value);
        $col = trim($request->col);
        $table = $request->table;
        $idCheck = $request->id_check;
        $check = false;
        switch($table) {
            case 0; // Vendors table
                $vendor = Vendor::select('id')->where($col, $value)->first();
                if($vendor) {
                    $check = true;
                    
                    if(!Utils::blank($idCheck) && $idCheck == $vendor['id']) {
                        $check = false;
                    }
                }
                break;
            default:
                break;
        }
        
        if(!$check) {
            echo 'true';
        } else {
            echo 'false';
        }
        exit;
    }
}
