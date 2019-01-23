<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\Constants\Status;
use App\Helpers\Utils;

class ApiController extends Controller
{
    public $output = ['code' => 404, 'data' => ''];
    
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
    
    public function updateStatus(Request $request) {
        $id = $request->id;
        $currentStatus = $request->current_status;
        $table = $request->table;
        
        switch($table) {
            case 0; // Vendors table
                $vendor = Vendor::find($id);
                $vendor->status = $currentStatus == 1 ? '0' : '1';
                if($vendor->save()) {
                    $this->output['code'] = 200;
                    $this->output['data'] = ['status' => $vendor->status, 'text' => Status::getData($vendor->status)];
                }
                break;
            default:
                break;
        }
        return response()->json($this->output);
    }
}
