<?php
namespace App\Repositories;


use App\Contracts\AdminUserContract;
use App\Models\Admin;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class AdminUserRepository extends BaseRepository implements AdminUserContract
{
    public function __construct(Admin $model)
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
    public function listUser(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns,$order,$sort);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findUserById(int $id)
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
    public function createUser(array $params)
    {
        // TODO: Implement createAddon() method.

        try{
            $collection = collect($params);
            $password   = $collection->has('password') ? bcrypt($collection['password']) : 00000000 ;
            $merge = $collection->merge(compact('password'));
            $user = new Admin($merge->all());
            $user->save();
            return $user;

        }catch (QueryException $exception){
            throw  new InvalidArgumentException($exception->getMessage());
        }
    }


    /**
     * @param array $params
     * @return mixed
     */
    public function updateUser(array $params)
    {
        // TODO: Implement updateAddon() method.

        $user = $this->findUserById($params['id']);

        $collection = collect($params)->except('_token');

        $password   = $collection->has('password') ? bcrypt($collection['password']) : $user->password ;
        $merge = $collection->merge(compact('password'));

        $user->update($merge->all());

        return $user;


    }

    public function deleteUser(int $id)
    {
        $user = $this->findUserById($id);

        $user->delete();

        return $user;
    }
}
