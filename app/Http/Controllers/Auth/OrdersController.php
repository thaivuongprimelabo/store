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
    public $rules = [];
    
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
        return view('auth.orders.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request) {
        $wheres = [];
        $output = ['code' => 200, 'data' => ''];
        if($request->isMethod('post')) {
            $id_search = $request->id_search;
            if(!Utils::blank($id_search)) {
                $wheres[] = ['id', '=', $id_search];
            }
            
            $name_search = $request->name_search;
            if(!Utils::blank($name_search)) {
                $wheres[] = ['customer_name', 'LIKE', '%' . $name_search . '%'];
            }
            
            $phone_search = $request->phone_search;
            if(!Utils::blank($phone_search)) {
                $wheres[] = ['customer_phone', '=', $phone_search];
            }
            
            $status_search = $request->status_search;
            if(!Utils::blank($status_search)) {
                $wheres[] = ['status', '=', $status_search];
            }
            
            $date_search = $request->date_search;
            if(!Utils::blank($date_search)) {
                $wheres[] = ['created_at', 'LIKE', '%' . $date_search . '%'];
            }
        }
        
        $orders = Order::where($wheres)->paginate(Common::ROW_PER_PAGE);
        
        $paging = $orders->toArray();
        
        if($request->ajax()) {
            $output['data'] = view('auth.orders.ajax_list', compact('orders', 'paging'))->render();
            return response()->json($output);
        } else {
            return compact('orders', 'paging');
        }
    }
    
    /**
     * create
     * @param Request $request
     */
    public function edit(Request $request) {
        $request->flash();
        
        $validator = [];
        
        $order = Order::find($request->id);
        $orderDetails = Product::select(
                            'order_details.product_id',
                            'products.name',
                            'order_details.qty',
                            'order_details.price',
                            'order_details.cost'
                        )
                        ->leftJoin('order_details', 'order_details.product_id', '=', 'products.id')
                        ->where('order_details.order_id', $request->id)->get();
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                
                $order = Order::find($request->id);
                
                $order->status         = Utils::cnvNull($request->status, 0);
                $order->updated_at     = date('Y-m-d H:i:s');
                
                if($order->save()) {
                    return redirect(route('auth_orders_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_orders_create'))->with('error', trans('messages.ERROR'));
            }
        }
        return view('auth.orders.edit', compact('order', 'orderDetails'))->withErrors($validator);;
    }
}
