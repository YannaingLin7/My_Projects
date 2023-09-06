<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    // direct user list page
    public function list() {
        $users = User::where('role','user')->paginate(5);
        return view('admin.userInfo.list',compact('users'));
    }


    // change Role
    public function changeRole(Request $request) {
        $data = [
            'role' => $request->role
        ];
        User::where('id',$request->userId)->update($data);
    }

}
