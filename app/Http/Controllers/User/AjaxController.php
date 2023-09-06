<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return products list
    public function productList(Request $request){
        if($request->status == 'desc'){
            $data = Product::orderBy('created_at','desc')->get();
        }else{
            $data = Product::orderBy('created_at','asc')->get();
        }
        return $data;
    }

    // Add to Cart
    public function addToCart(Request $request) {
        $orderData = $this->getOrderData($request);
        Cart::create($orderData);

        $response = [
            'message' => 'Successfully added to cart',
            'status' => 'success'
        ];

        return response()->json($response, 200);
    }

    // Sending Data to Database
    public function order(Request $request) {
        $totalAmount = 0;
        foreach($request->all() as $item) {
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code']
            ]);
            $totalAmount += $data->total;
        }

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $totalAmount+3000
        ]);

        return response()->json([
            'status' => 'true',
            'message'=>'order success'
        ],200);
    }

    // getting Order Data
    private function getOrderData($request) {
        return[
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

    // clear Cart
    public function clearCart() {
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    // clear current product
    public function clearCurrentProduct(Request $request) {
        Cart::where('user_id',Auth::user()->id)
            ->where('product_id',$request->productId)
            ->where('id', $request->orderId)->delete();
    }

    // Increasing View Count Function
    public function increaseViewCount(Request $request){
        $data = Product::where('id',$request->productId)->first();
        $viewCount = ['view_count' => $data->view_count +1];

        Product::where('id',$request->productId)->update($viewCount);
    }
}
