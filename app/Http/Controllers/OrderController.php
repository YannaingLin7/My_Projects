<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //Direct to order list page
    public function list() {
        $order = Order::select('orders.*', 'users.name as user_name')
                    ->when(request('key'), function($query) {
                    $query->where('orders.order_code','like','%'.request('key').'%');})
                    ->leftJoin('users','users.id','orders.user_id')
                    ->orderBy('created_at','desc')
                    ->get();
        return view('admin.order.list',compact('order'));
    }

    // Sort by order Status with ajax
    public function changeStatus(Request $request){
        $order = Order::select('orders.*', 'users.name as user_name')
                    ->when(request('key'), function($query) {
                    $query->where('orders.order_code','like','%'.request('key').'%');})
                    ->leftJoin('users','users.id','orders.user_id')
                    ->orderBy('created_at','desc');

        if($request->orderStatus == null){
            $order = $order->get();
        }else{
            $order = $order->where('orders.status',$request->orderStatus)
                        ->get();
        }
        return view('admin.order.list',compact('order'));
    }

    public function ajaxChangeStatus (Request $request) {
        Order::where('id', $request->orderId)->update([
            'status' => $request->status
        ]);
    }

    public function orderInfo ($orderCode) {
        $order = Order::where('order_code',$orderCode)->first();
        $orderList = OrderList::select('order_lists.*','users.name as user_name','products.image as product_image','products.name as product_name')
                        ->leftJoin('products','products.id','order_lists.product_id')
                        ->leftJoin('users','users.id','order_lists.user_id')
                        ->where('order_code',$orderCode)->get();
        return view('admin.order.orderInfo', compact('orderList','order'));
    }
}
