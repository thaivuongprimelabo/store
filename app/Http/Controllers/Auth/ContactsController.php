<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Common;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;

class ContactsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request) {
        return view('auth.contacts.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request) {
        $wheres = [];
        $output = ['code' => 200, 'data' => ''];
        if($request->isMethod('post')) {
            $email_search = $request->email_search;
            if(!Utils::blank($email_search)) {
                $wheres[] = ['email', '=', $email_search];
            }
            
            $phone_search = $request->phone_search;
            if(!Utils::blank($phone_search)) {
                $wheres[] = ['phone', '=', $phone_search];
            }
            
            $status_search = $request->status_search;
            if(!Utils::blank($status_search)) {
                $wheres[] = ['status', '=', $status_search];
            }
        }
        
        $contacts = Contact::where($wheres)->paginate(Common::ROW_PER_PAGE);
        
        $paging = $contacts->toArray();
        
        if($request->ajax()) {
            $output['data'] = view('auth.contacts.ajax_list', compact('contacts', 'paging'))->render();
            return response()->json($output);
        } else {
            return compact('contacts', 'paging');
        }
    }
}
