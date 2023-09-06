<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // (direct user home page)
    public function homePage() {
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.home',compact('pizza','category','cart', 'history'));
    }

    // Filtering by Category
    public function filter($categoryId) {
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.home',compact('pizza','category','cart', 'history'));
    }

    // direct change password page
    public function changePasswordPage() {
        return view('user.password.change');
    }

    // change Password function
    public function changePassword( Request $request) {
        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword = $user->password;

        if (Hash::check($request->oldPassword, $dbPassword)) {
            User::where('id',Auth::user()->id)->update(['password'=>Hash::make($request->newPassword)]);

            // Auth::logout();
            // return redirect()->route('category#list');
            return back()->with(['changeSuccess'=>'Changed Password Successfully...']);
        } else {
            return back()->with(['notMatch'=> 'The passwords are not match. Try again']);
        }
    }

    // direct user profile page
    public function profilePage() {
        return view('user.account.profile');
    }

    // Edit User Profile
    public function editProfile($id, Request $request) {
        $this->profileValidationCheck($request);
        $data = $this->getUserData ($request);

        // for image
        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $oldImage = $dbImage->image;

            if($oldImage != null) {
                Storage::delete('public/'.$oldImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return redirect()->route('user#profilePage')->with(['updateSuccess' => 'Admin Account Updated...']);
    }

    // Direct Pizza Detail Page
    public function pizzaDetail ($productId) {
        $product = Product::where('id',$productId)->first();
        $productList = Product::get();
        return view('user.detail',compact('product','productList'));
    }

    // Direct to Cart Page
    public function cartList () {
        $cartList = Cart::select('carts.*','products.name as product_name', 'products.price as product_price', 'products.image as product_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)
                    ->get();

        $totalPrice = 0;
        foreach($cartList as $c) {
            $totalPrice += $c->product_price * $c->qty;
        };

        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    // Direct Order History Page
    public function history() {
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate('5');
        return view('user.main.history', compact('order'));
    }

    // PRIVATE FUNCTIONS

    // Getting user Data
    private function getUserData ($request) {
        return [
            'name' =>    $request->name,
            'email' =>   $request->email,
            'gender' =>  $request->gender,
            'address' => $request->address,
            'phone' =>   $request->phone,
            'updated_at' => Carbon::now()
        ];
    }

    private function profileValidationCheck ($request) {
        Validator::make($request->all(),[
            'name'=>    'required',
            'email'=>   'required',
            'gender' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp |file',
            'address'=> 'required',
            'phone' =>  'required',
        ])->validate();
    }

    // password validator check
    private function passwordValidationCheck ($request) {
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword'
        ],)->validate();
    }


}
