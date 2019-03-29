<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Utils;
use App\Member;

class MembersController extends AppController
{
    public $breadcrumb = [];
    protected $guard = 'member';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->breadcrumb = [route('home') => trans('shop.home')];
    }
    
    public function index(Request $request) {
        
        $this->breadcrumb['active'] = trans('shop.login');
        $breadcrumb  = $this->breadcrumb;
        $showSidebar = 'hide';
        
        if($request->isMethod('post')) {
            $credential = [
                'email' => $request->email, 
                'password' => $request->password
            ];
            
            if (Auth::guard($this->guard)->attempt($credential)) {
                return redirect('/');
            }
        }
        
        return view('shop.login', compact('breadcrumb', 'showSidebar'));
    }
    
    public function register(Request $request) {
        
        $validator = [];
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'captcha' => 'required'
        ];
        
        if($request->getSession()->has('captcha')) {
            $rules['captcha'] = 'required|captcha';
        }
        
        $validator = Validator::make($request->all(), $rules);
        
        if(!$validator->fails()) {
            $member = new Member();
            $member->name = Utils::cnvNull($request->name, '');
            $member->email = Utils::cnvNull($request->email, '');
            $member->password = bcrypt($request->password);
            $member->phone = Utils::cnvNull($request->phone, '');
            $member->address = Utils::cnvNull($request->address, '');
            $member->created_at = date('Y-m-d H:i:s');
            $member->updated_at = date('Y-m-d H:i:s');
            
            $config = [
                'subject' => '[' . $this->config['config']['web_name'] . '] Thông tin tài khoản',
                'msg' => [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password,
                    'phone' => $request->phone,
                    'address' => $request->address
                ],
                'to'       => $request->email,
                'template' => 'shop.emails.register'
            ];
            
            if(Utils::sendMail($config)) {
                if($member->save()) {
                    return redirect(route('login'))->with('success', trans('messages.REG_SUCCESS'));
                }
            }
        } 
        else {
            return redirect(route('login'))->with('error', trans('messages.ERROR'));
        }
    }
    
    public function logout(Request $request) {
        Auth::guard($this->guard)->logout();
        
        $request->session()->invalidate();
        
        return redirect('/');
    }
    
    public function checkCaptcha(Request $request) {
        $result = [
            'code' => 200,
            'data' => ''
        ];
        
        $captcha = $request->captcha;
        
        $rules = [
            'captcha' => 'required|captcha'
        ];
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails()) {
            $result['data'] = trans('validation.captcha');
        }
        
        return response()->json($result);
    }
    
    
    public function refreshCaptcha() {
        return response()->json(['captcha'=> captcha_img('flat')]);
    }
}
