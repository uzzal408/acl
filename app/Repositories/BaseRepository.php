<?php


namespace App\Repositories;


use App\Contracts\BaseContract;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 * @package App\Repositories
 */


abstract class BaseRepository implements BaseContract{

    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return mixed|void
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return bool
     */
    public function update(array $attributes, int $id):bool
    {
       return $this->find($id)->update($attributes);
    }

    /**
     * @param array $column
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function all($column = array('*'), $orderBy = 'id', $sortBy = 'desc')
    {
        return $this->model->orderBy($orderBy,$sortBy)->get($column);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findOneOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function  findBy(array $data)
    {
        return $this->model->where($data)->all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function findOneBy(array $data)
    {
       return $this->model->where($data)->first();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function findOneByeOrFail(array $data)
    {
       return $this->model->where($data)->findOrFail();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id):bool
    {
       $this->model->find($id)->delete();
    }


}