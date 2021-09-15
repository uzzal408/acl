<?php
namespace App\Contracts;
/**
 * Interface BaseContract
 * Package BaseContract
 */

interface BaseContract{
    /**
     * create  model instance
     * @param array attributes
     * @return mixed
     */

    public function create(array $attributes);

    /**
     * update  model instance
     * @param array $attribute
     * @param int $id
     * @return mixed
     */

    public function update(array $attributes,int $id);

    /**
     * Return all model row
     * @param array $column
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */

    public function all($column=array('*'),$orderBy = 'id',$sortBy='desc');

    /**
     * Find one by id
     * @param int $id
     * @return mixed
     */

    public function find(int $id);

    /**
     * Find one by id or throw exception
     * @param int $id
     * @return mixed
     */

    public function findOneOrFail(int $id);

    /**
     * Find based on different column
     * @param array $data
     * @return mixed
     */

    public function findBy(array $data);

    /**
     * Find one based on a different column
     * @param array $data
     * @return mixed
     */

    public  function findOneBy(array $data);

    /**
     * Find one base ond different data or throw exception
     * @param array $data
     * @return mixed
     */

    public function findOneByeOrFail(array $data);

    /**
     * Delete One by id
     * $param int $id
     * @return mixed
     */

    public function delete(int $id);



}