<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Booking;
use App\Helpers\Utils;

class BookingController extends AppController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        parent::__construct();
        
        $this->middleware('auth');
        
    }
    
    public function index(Request $request) {
        return view('auth.booking.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request) {
        return $this->doSearch($request, new Booking(), '', 'auth.booking.ajax_list');
    }
    
    /**
     * create
     * @param Request $request
     */
    public function create(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                $data = new Booking();
                $data->name         = Utils::cnvNull($request->name, '');
                $data->phone        = Utils::createNameUrl(Utils::cnvNull($request->phone, ''));
                $data->booking_date = Utils::cnvNull($request->booking_time, 0);
                $data->booking_time = Utils::cnvNull($request->booking_time, 0);
                $data->note         = Utils::cnvNull($request->note, 0);
                $data->status       = Utils::cnvNull($request->status, 0);
                $data->created_at   = date('Y-m-d H:i:s');
                $data->updated_at   = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    return redirect(route('auth_booking_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_booking_create'))->with('error', trans('messages.ERROR'));
            }
        }
        
        return view('auth.form', $this->output);
    }
    
    /**
     * edit
     * @param Request $request
     */
    public function edit(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        $data = Booking::find($request->id);
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                $data = Booking::find($request->id);
                $data->name         = Utils::cnvNull($request->name, '');
                $data->phone        = Utils::createNameUrl(Utils::cnvNull($request->phone, ''));
                $data->booking_date = Utils::cnvNull($request->booking_time, 0);
                $data->booking_time = Utils::cnvNull($request->booking_time, 0);
                $data->note         = Utils::cnvNull($request->note, 0);
                $data->status       = Utils::cnvNull($request->status, 0);
                $data->updated_at   = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    return redirect(route('auth_booking_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_booking_edit', ['id' => $request->id]))->with('error', trans('messages.ERROR'));
            }
            
        }
        
        $this->output['data'] = $data;
        return view('auth.form', $this->output);
    }
    
    public function remove(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->id;
            $data = Booking::find($id);
            if($data->delete()) {
                return redirect(route('auth_booking'))->with('success', trans('messages.REMOVE_SUCCESS'));
            }
        }
    }
}
