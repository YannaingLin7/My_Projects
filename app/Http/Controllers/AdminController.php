<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // Direct Change Password Page
    public function changePasswordPage() {
        return view('admin.account.changePassword');
    }

    // Change Password
    public function changePassword (Request $request) {
        // validation for changing Password
        // 1. all field must be filled
        // 2. new password and confirm must be same
        // 3. old password and password in database must be same


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

    // Direct profilePage
    public function profile() {
        return view('admin.account.info');
    }

    // Direct Edit Profile Page
    public function editProfile () {
        return view('admin.account.editProfile');
    }

    // Update Profile Function
    public function updateProfile ($id, Request $request) {
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
        return redirect()->route('admin#profilePage')->with(['updateSuccess' => 'Admin Account Updated...']);
    }

    // Directing Admin List Page
    public function list() {
        $admin = User::when(request('key'), function ($query) {
                    $query->orWhere('name','like','%'.request('key').'%')
                          ->orWhere('email','like','%'.request('key').'%')
                          ->orWhere('gender','like','%'.request('key').'%')
                          ->orWhere('phone','like','%'.request('key').'%')
                          ->orWhere('address','like','%'.request('key').'%');
                })
                ->where('role','admin')->paginate(3);
        $admin->appends(request()->all());
        return view('admin.account.list',compact('admin'));
    }

    // Delete admin account
    public function delete($id) {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess'=>'Admin Account Deleted...']);
    }

    // Role Changing
    public function change($id,Request $request) {
        $data = $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    private function requestUserData($request) {
        return [
            'role' => $request->role
        ];
    }

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

    // profile validator function
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

    // password validator function
    private function passwordValidationCheck ($request) {
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword'
        ],)->validate();
    }
}
