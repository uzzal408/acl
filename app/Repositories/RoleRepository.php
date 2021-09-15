<?php
namespace App\Repositories;

use App\Contracts\RoleContract;
use App\Models\Role;

class RoleRepository extends BaseRepository implements RoleContract
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listRoles(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns,$order,$sort);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findRoleById(int $id)
    {
        try{
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e){
            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Addon|mixed
     */
    public function createRole(array $params)
    {
        try{
            $collection = collect($params);
            $category   = $collection->has('category') ?  $collection['category']  : 0 ;
            $user   = $collection->has('user') ?  $collection['user']  : 0 ;
            $role   = $collection->has('role') ?  $collection['role']  : 0 ;
            $permissions = array(
                ['model'=>'category','permissions'=>$category],
                ['model'=>'user','permissions'=>$user],
                ['model'=>'role','permissions'=>$role],
            );

            $permissions = json_encode($permissions);

            $merge = $collection->merge(compact('permissions'));
            $role = new Role($merge->all());
            $role->save();
            return $role;

        }catch (QueryException $exception){
            throw  new InvalidArgumentException($exception->getMessage());
        }
    }


    /**
     * @param array $params
     * @return mixed
     */
    public function updateRole(array $params)
    {

        $role = $this->findRoleById($params['id']);
        $collection = collect($params)->except('_token');

        $category   = $collection->has('category') ?  $collection['category']  : 0 ;
        $user   = $collection->has('user') ?  $collection['user']  : 0 ;
        $role   = $collection->has('role') ?  $collection['role']  : 0 ;
        $permissions = array(
            ['model'=>'category','permissions'=>$category],
            ['model'=>'user','permissions'=>$user],
            ['model'=>'role','permissions'=>$role],
        );

        $permissions = json_encode($permissions);

        $merge = $collection->merge(compact('permissions'));

        $role->update($merge->all());

        return $role;


    }

    public function deleteRole(int $id)
    {

        $role = $this->findRoleById($id);

        $role->delete();

        return $role;
    }
}
