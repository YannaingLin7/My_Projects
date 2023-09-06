<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function list () {
        $pizzas = Product::select('products.*','categories.name as category_name')
            ->when(request('key'), function($query) {
            $query->where('products.name','like','%'.request('key').'%');})
            ->leftJoin('categories','products.category_id', 'categories.id')
            ->orderBy('products.created_at', 'desc')
            ->paginate(5);
        return view ('admin.products.pizza', compact('pizzas'));
        $pizzas->append(request()->all());
    }

    // Direct Product Create Page
    public function createPage() {
        $categories = Category::select('id','name')->get();
        return view ('admin.products.create',compact('categories'));
    }

    // Product Create
    public function create( Request $request) {
        $this->productValidationCheck($request,"create");
        $productInfo = $this->fetchProductInfo($request);

        if($request->hasFile('productImage')) {
            $fileName = uniqid().$request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public',$fileName);
            $productInfo['image'] = $fileName;
        }

        Product::create($productInfo);

        return redirect()->route('product#list');
    }

    // Update Product
    public function update(Request $request) {
        $this->productValidationCheck($request,"update");
        $data = $this->fetchProductInfo($request);

        if($request->hasFile('productImage')) {
            $oldData = Product::where('id',$request->productId)->first();
            $oldImageName = $oldData->image;

            if ($oldImageName != null) {
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid().$request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        Product::where('id',$request->productId)->update($data);
        return redirect()->route('product#list');
    }

    // Product Delete
    public function delete($id) {
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess'=>'Deleted ...']);
    }

    // Direct Detail Page
    public function detailPage($id) {
        $pizzas = Product::select('products.*','categories.name as category_name')
                    ->leftJoin('categories', 'products.category_id', 'categories.id')
                    ->where('products.id',$id)->first();
        return view('admin.products.detail',compact('pizzas'));
    }

    // Direct Edit Page
    public function editPage($id) {
        $pizza = Product::where('id',$id)->first();
        $categories = Category::get();
        return view('admin.products.editPage',compact('pizza','categories'));
    }



    // Fetching Product information
    private function fetchProductInfo ($request) {
        return [
            'category_id' => $request->productCategory,
            'name' => $request->productName,
            'description' => $request->productDescription,
            'price' => $request->productPrice,
            'waiting_time' => $request->productWaitingTime
        ];
    }

    // Validation for Creating Product
    private function productValidationCheck ($request, $action) {
        $validationRules = [
            'productName' => 'required|min:5|unique:products,name,'.$request->productId ,
            'productCategory' => 'required',
            'productDescription' => 'required',
            'productWaitingTime' => 'required',
            'productPrice' => 'required'
        ];

        if ($action == 'create') {
            $validationRules['productImage'] = 'required|mimes:jpg,jpeg,png,webp|file';
        } else {
            $validationRules['productImage'] = 'mimes:jpg,jpeg,png,webp|file';
        }
        Validator::make($request->all(),$validationRules)->validate();
    }


}
