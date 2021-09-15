<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\AdminUserContract;
use App\Contracts\RoleContract;
use App\Contracts\StoreContract;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class AdminUserController extends BaseController
{
    protected $userRepository;
    protected $roleRepository;

    public function __construct(AdminUserContract $contract,RoleContract $roleContract)
    {
        $this->userRepository = $contract;
        $this->roleRepository = $roleContract;
    }

    public function index()
    {
        $users = $this->userRepository->listUser();
//        dd($users);
        $this->setPageTitle('Users','List of all Users');
        return view('admin.user.index',compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $roles = $this->roleRepository->listRoles('title','asc');
        $this->setPageTitle('Users','Create user');
        return view('admin.user.create',compact('roles'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'email'          => 'required|max:191|unique:admins',
            'name'          => 'required|max:191',
            'role_id'       => 'required|integer',
            'password'      => 'required|min:8|confirmed'
        ]);

        $params = $request->except('_token');
        $user = $this->userRepository->createUser($params);
        if(!$user){
            return $this->responseRedirectBack('Error occurred while creating user','error',true,true);
        }

        return $this->responseRedirect('admin.user.index','User Added Successfully','success',false,false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {

        $targetUser = $this->userRepository->findUserById($id);
        $roles = $this->roleRepository->listRoles('title','asc');
        $this->setPageTitle('Users','Edit User : '.$targetUser->name);
        return view('admin.user.edit',compact('targetUser','roles'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request){
        $user = Admin::find($request->id);
        if($user->email != $request->email) {
            $this->validate($request, [
                'email' => 'required|max:191|unique:admins',
                'name' => 'required|max:191',
                'role_id' => 'required|integer',
                'password'      => 'required|min:8|confirmed'
            ]);
        }else{
            $this->validate($request, [
                'email' => 'required|max:191',
                'name' => 'required|max:191',
                'role_id' => 'required|integer',
//                'password'      => 'required|min:8|confirmed'
            ]);
        }

        $params = $request->except('_token');

        $coupon = $this->userRepository->updateUser($params);

        if(!$coupon){
            return $this->responseRedirectBack('Error occurred while updating user','error',true,true);
        }

        return $this->responseRedirectBack('User updated successfully','success',false,false);
    }

    public function delete($id){
        $user = $this->userRepository->deleteUser($id);

        if(!$user){
            return $this->responseRedirectBack('Error occurred while deleting user','error',true,true);
        }

        return $this->responseRedirect('admin.user.index','User  deleted successfully','success',false,false);
    }
}

