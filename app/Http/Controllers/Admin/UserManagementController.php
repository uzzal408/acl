<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends BaseController
{
    public function user(){
        $this->setPageTitle(Auth::guard('admin')->user()->name,'User Details');
        return view('admin.users.user-details');
    }

    public function change_password(){
        $this->setPageTitle('Users','Change user password');
        return view('admin.users.change-password');
    }
    public function password_store(Request $request){
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        $user = Admin::find(Auth::guard('admin')->user()->id);
        $pass = $request->password;
        $oldpassInput =  $request->old_password;
        if(Hash::check($oldpassInput,$user->password)){
        $password =  bcrypt($pass);
        $user->password = $password;
        $update = $user->save();
        }else{
            $update = false;
        }

        if(!$update){
            return $this->responseRedirectBack('Password does not match','error',true,false);
        }
        return $this->responseRedirect('admin.users.detail','Password Updated Successfully','success',false,false);
    }

}
