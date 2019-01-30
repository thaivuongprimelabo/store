<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Common;
use App\Constants\Status;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contact;
use App\Constants\ContactStatus;

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
    
    /**
     * create
     * @param Request $request
     */
    public function edit(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        $contact = Contact::find($request->id);
        
        if($request->isMethod('post')) {
            
            $maxSize =  Utils::formatMemory(Common::ATTACHMENT_MAX_SIZE, true);
            
            $validator = Validator::make($request->all(), [
                'reply_content' => 'required|max:' . Common::DESC_MAXLENGTH,
                'banner' => 'max:'.$maxSize.'|mimes:'. Common::FILE_EXT1
            ]);
            
            if (!$validator->fails()) {
                
                $filename = $contact->attachment;
                if($request->hasFile('attachment')) {
                    
                    $file = $request->attachment;
                    
                    $filename = Utils::uploadFile($file, Common::ATTACHMENT_FOLDER, false);
                }
                $contact->attachment = $filename;
                $contact->reply_content = $request->input('reply_content', '');
                $contact->status = ContactStatus::REPLIED_CONTACT;
                $contact->updated_at = date('Y-m-d H:i:s');
                
                // Config mail
                $config = [
                    'msg' => ['content' => $contact->reply_content],
                    'pathToFile' => Common::UPLOAD_FOLDER . $filename,
                    'to' => $contact->email
                ];
                
                if(Utils::sendMail($config)) {
                    if($contact->save()) {
                        return redirect(route('auth_contacts'))->with('success', trans('messages.UPDATE_SUCCESS'));
                    }
                } else {
                    return redirect(route('auth_contacts'))->with('error', trans('messages.ERROR'));
                }
            } else {
                return redirect(route('auth_contacts'))->with('error', trans('messages.ERROR'));
            }
        }
        return view('auth.contacts.edit', compact('contact'))->withErrors($validator);;
    }
    
    public function remove(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->id;
            $contact = Contact::find($id);
            if($contact->delete()) {
                Utils::removeFile($contact->attachment);
                return redirect(route('auth_contacts'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
}
