<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Common;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;

class UsersController extends Controller
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
        return view('auth.users.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request) {
        $output = ['code' => 200, 'data' => ''];
        $wheres = [];
        if($request->isMethod('post')) {
            $id_search = $request->id_search;
            if(!Utils::blank($id_search)) {
                $wheres[] = ['id', '=', $id_search];
            }
            
            $name_search = $request->name_search;
            if(!Utils::blank($name_search)) {
                $wheres[] = ['name', 'LIKE', '%' . $name_search . '%'];
            }
            
            $status_search = $request->status_search;
            if(!Utils::blank($status_search)) {
                $wheres[] = ['status', '=', $status_search];
            }
            
            $email_search = $request->email_search;
            if(!Utils::blank($email_search)) {
                $wheres[] = ['email', '=', $email_search];
            }
        }
        
        $users = User::where($wheres)->whereIn('role_id', [Common::ADMIN, Common::MEMBER])->paginate(Common::ROW_PER_PAGE);
        
        $paging = $users->toArray();
        
        if($request->ajax()) {
            $output['data'] = view('auth.users.ajax_list', compact('users', 'paging'))->render();
            return response()->json($output);
        } else {
            return compact('users', 'paging');
        }
    }
    
    /**
     * create
     * @param Request $request
     */
    public function create(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        if($request->isMethod('post')) {
            
            $maxSize =  Utils::formatMemory(Common::LOGO_MAX_SIZE, true);
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:' . Common::NAME_MAXLENGTH,
            ]);
            
            if (!$validator->fails()) {
                
                $filename = '';
                if($request->hasFile('avatar')) {
                    
                    $file = $request->avatar;
                    
                    $filename = Utils::uploadFile($file, Common::AVATAR_FOLDER);
                }
                
                $user = new User();
                $user->name = $request->input('name', '');
                $user->email = $request->input('email', '');
                $user->password = Hash::make($request->input('password', ''));
                $user->avatar = $filename;
                $user->role_id = $request->input('role_id', '');;
                $user->status = $request->input('status', 0);
                $user->created_at = date('Y-m-d H:i:s');
                $user->updated_at = date('Y-m-d H:i:s');
                
                if($user->save()) {
                    return redirect(route('auth_users_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_users_create'))->with('error', trans('messages.ERROR'));
            }
        }
        
        return view('auth.users.create')->withErrors($validator);
    }
    
    /**
     * edit
     * @param Request $request
     */
    public function edit(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        $user = User::find($request->id);
        
        if($request->isMethod('post')) {
            
            $maxSize =  Utils::formatMemory(Common::LOGO_MAX_SIZE, true);
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:' . Common::NAME_MAXLENGTH,
            ]);
            
            if (!$validator->fails()) {
                $user = User::find($request->id);
                
                $filename = $user->avatar;
                
                if($request->hasFile('avatar')) {
                    
                    $file = $request->avatar;
                    
                    $filename = Utils::uploadFile($file, Common::AVATAR_FOLDER);
                }
                
                $user->name = $request->input('name', '');
                $user->email = $request->input('email', '');
                if(!Utils::blank($request->password)) {
                    $user->password = $request->input('password', '');
                }
                $user->avatar = $filename;
                $user->role_id = $request->input('role_id', '');;
                $user->status = $request->input('status', 0);
                $user->updated_at = date('Y-m-d H:i:s');
                
                if($user->save()) {
                    return redirect(route('auth_users_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
                
            } else {
                return redirect(route('auth_users_edit', ['id' => $request->id]))->with('error', trans('messages.ERROR'));
            }
        }
        
        return view('auth.users.edit', compact('user'))->withErrors($validator);
    }
    
    public function profile(Request $request) {
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:' . Common::NAME_MAXLENGTH,
            ]);
            
            if (!$validator->fails()) {
                $user = User::find($request->id);
                
                $filename = $user->avatar;
                
                if($request->hasFile('avatar')) {
                    
                    $file = $request->avatar;
                    
                    $filename = Utils::uploadFile($file, Common::AVATAR_FOLDER);
                }
                
                $user->name = $request->input('name', '');
                if(!Utils::blank($request->password)) {
                    $user->password = $request->input('password', '');
                }
                $user->avatar = $filename;
                $user->updated_at = date('Y-m-d H:i:s');
                
                if($user->save()) {
                    return redirect(route('auth_profile'))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
                
            } else {
                return redirect(route('auth_profile'))->with('error', trans('messages.ERROR'));
            }
        }
        return view('auth.users.profile');
    }
    
    public function remove(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->id;
            $user = User::find($id);
            if($user->delete()) {
                return redirect(route('auth_users'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
}
