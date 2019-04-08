<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Common;
use App\Helpers\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Order;
use App\OrderDetails;
use App\Product;

class OrdersController extends AppController
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
        return view('auth.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request) {
        return $this->doSearch($request, new Order());
    }
    
    /**
     * create
     * @param Request $request
     */
    public function edit(Request $request) {
        $request->flash();
        
        $validator = [];
        
        $data = Order::find($request->id);
        $orderDetails = OrderDetails::select(
                            'order_details.product_id',
                            'order_details.qty',
                            'order_details.price',
                            'order_details.cost'
                        )
                        ->where('order_details.order_id', $request->id)
                        ->where('order_details.product_detail_id', 0)
                        ->get();
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                
                $data->status         = Utils::cnvNull($request->status, 0);
                $data->updated_at     = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    return redirect(route('auth_orders_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_orders_create'))->with('error', trans('messages.ERROR'));
            }
        }
        
        $this->output['data'] = $data;
        return view('auth.orders.form', $this->output);
    }
}
