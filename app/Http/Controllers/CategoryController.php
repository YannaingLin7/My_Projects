<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Direct Category List Page
    public function list() {
        $categories = Category::
                                when(request('key'),function($query){
                                    $query->where('name','like', '%' . request('key') . '%');
                                    })
                                ->orderBy('id','desc')->paginate(5);

        $categories->appends(request()->all());
        return view('admin.category.list', compact('categories'));
    }

    // Direct Category Create Page
    public function createPage() {
        return view('admin.category.create');
    }

    // Create Category 
    public function create(Request $request) {
        $this->CategoryValidationCheck($request );
        $data= $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['createSuccess'=>'Category Created...']);
    }

    // Delete Category
    public function delete($id) {
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Category Deleted']);
    }

    // Direct Category Edit Page
    public function edit($id) {
        $category = Category::where('id',$id)->first();   
        return view('admin.category.edit',compact('category'));
    }

    // Category Update 
    public function update( Request $request) {
        $this->CategoryValidationCheck($request );
        $data= $this->requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list');
    }

    // Checking Validation for Category
    private function CategoryValidationCheck($request) {
        Validator::make($request->all(),[
            'categoryName'=>'required|unique:categories,name,'.$request->categoryId
        ])->validate();
    }

    // Changing requested data into array form (ဒေတာကို table သို့ သွင်းသည့်အခါ Array format ဖြစ်ရန်လိုအပ်သောကြောင့်)
    private function requestCategoryData($request) {
        return [
            'name'=> $request->categoryName
        ];
    }
}
