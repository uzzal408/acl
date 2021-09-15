<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\RoleContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class RoleController extends BaseController
{
    protected $roleRepository;

    public function __construct(RoleContract $contract)
    {
        $this->roleRepository = $contract;
    }

    public function index()
    {
        $roles = $this->roleRepository->listRoles();

        $this->setPageTitle('Role','List of all roles');
        return view('admin.roles.index',compact('roles'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $this->setPageTitle('Role','Create role');
        return view('admin.roles.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'title'          => 'required|max:191|unique:roles',
        ]);
        $params = $request->except('_token');
        $role = $this->roleRepository->createRole($params);

        if(!$role){
            return $this->responseRedirectBack('Error occurred while creating role','error',true,true);
        }

        return $this->responseRedirect('admin.roles.index','Role Added Successfully','success',false,false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetRole = $this->roleRepository->findRoleById($id);
        $permissionJson = $targetRole->permissions;
        $permission = json_decode($permissionJson);
        foreach ($permission as $per){
            if($per->model=='category'){
                $category = $per->permissions;
            }
            if($per->model == 'user'){
                $user = $per->permissions;
            }
            if($per->model == 'role'){
                $role = $per->permissions;
            }
        }
        if(!isset($category)){
            $category = 0;
        }
        if(!isset($user)){
            $user = 0;
        }

        if(!isset($role)){
            $role = 0;
        }
        $this->setPageTitle('Roles','Edit role : '.$targetRole->id);
        return view('admin.roles.edit',compact('targetRole','category','user','role'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request){

        $this->validate($request,[
            'title'          => 'required|max:191',
        ]);

        $params = $request->except('_token');

        $role = $this->roleRepository->updateRole($params);

        if(!$role){
            return $this->responseRedirectBack('Error occurred while updating role','error',true,true);
        }

        return $this->responseRedirectBack('Role updated successfully','success',false,false);
    }

    public function delete($id){
        $role = $this->roleRepository->deleteRole($id);

        if(!$role){
            return $this->responseRedirectBack('Error occurred while deleting role','error',true,true);
        }

        return $this->responseRedirect('admin.roles.index','Role  deleted successfully','success',false,false);
    }
}
