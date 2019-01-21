<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Vendor;
use App\Constants\Status;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    //
    public function index(Request $request) {
        return view('auth.vendors.index', $this->search($request));
    }
    
    public function search(Request $request) {
        $wheres = [];
        $output = ['code' => 200, 'data' => ''];
        $type = '';
        if($request->isMethod('post')) {
            $type = $request->type;
            $id_search = $request->id_search;
            if(!$this->blank($id_search)) {
                $wheres[] = ['id', '=', $id_search];
            }
            
            $name_search = $request->name_search;
            if(!$this->blank($name_search)) {
                $wheres[] = ['name', 'LIKE', '%' . $name_search . '%'];
            }
            
            $status_search = $request->status_search;
            if(!$this->blank($status_search)) {
                $wheres[] = ['status', '=', $status_search];
            }
        }
        
        $vendors = Vendor::where($wheres)->paginate(config('master.row_per_page'));
        
        $paging = $vendors->toArray();
        
        if($type == 'ajax') {
            $output['data'] = view('auth.vendors.ajax_list', compact('vendors', 'paging'))->render();
            return json_encode($output);
        } else {
            return ['vendors' => $vendors, 'paging' => $paging];
        }
    }
    
    /**
     * Determine if the given value is "blank".
     *
     * @param  mixed  $value
     * @return bool
     */
    function blank($value)
    {
        if (is_null($value)) {
            return true;
        }
        
        if (is_string($value)) {
            return trim($value) === '';
        }
        
        if (is_numeric($value) || is_bool($value)) {
            return false;
        }
        
        return empty($value);
    }
}
