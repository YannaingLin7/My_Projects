<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    // Get All Product and User
    public function productList(){
        $product = Product::orderBy('id','desc')->get();
        $user = User::get();

        $data = [
            'product' => $product,
            'user' => $user
        ];
        return response()->json($product, 200);
    }

    // Get All Categories
    public function categoryList(){
        $category = Category::orderBy('id','desc')->get();
        return response()->json($category, 200);
    }

    // Create Category
    public function createCategory(Request $request) {
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Category::create($data);
        return response()->json($response, 200);
    }

    // creating contact
    public function createContact(Request $request){
        $data = $this->getContactData($request);

        $response = Contact::create($data);
        return response()->json($response, 200);
    }

        // getting contacts data
        private function getContactData($request){
            return [
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

    // Delete contact
    public function deleteCategory(Request $request){
        $data = Category::where('id',$request->category_id)->first();
        if(isset($data)){
            Category::where('id',$request->category_id)->delete();
            return response()->json(['data status' => true,'message' => 'Delete Success'], 200);
        }else{
            return response()->json(['data status' => false, 'message' => 'There is no category for this Id'], 404);
        }
    }

    // Showing details of each category
    public function categoryDetail (Request $request){
        $data = Category::where('id',$request->category_id)->first();
        if(isset($data)){
            return response()->json(['data status' => true, 'category'=>$data], 200,);
        }else{
            return response()->json(['data status'=> false, 'message'=> 'There is no category for this Id'], 404);
        }
    }

    // Updating cateogry
    public function updateCategory(Request $request){
        $categoryId = $request->category_id;
        $dbSource = Category::where('id',$categoryId)->first();

        if(isset($dbSource)){
            $data = $this->getCategoryData($request);
            $updateData = Category::where('id',$categoryId)->update($data);
            $response = Category::where('id',$categoryId)->first();
            return response()->json(['message' => 'updated sucess', 'category' => $response], 200);
        }else{
            return response()->json(['data status'=> false, 'message'=> 'There is no category for this Id'], 404);
        }
    }


    // Showing contact list
    public function contactList(){
        $data = Contact::orderBy('created_at','desc')->get();
        return response()->json($data, 200);
    }

    // Getting category data
    private function getCategoryData ($request) {
        return [
            'name' => $request->category_name,
            'updated_at' => Carbon::now()
        ];
    }
}
