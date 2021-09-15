<?php

namespace App\Repositories;

use App\Models\Category;
use App\Traits\UploadAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use App\Contracts\CategoryContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;


/**
 * Class CategoryRepository
 * @package App\Repositories
 */
 class CategoryRepository extends BaseRepository implements CategoryContract
{
    use UploadAble;

    /**
     * CategoryRepository constructor.
     * @param Category $model
     */
    public function __construct(Category $model)
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
    public function listCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*'], int $paginetion=null)
    {
        if($paginetion==null){
            return $this->all($columns,$order,$sort);
        }else{
            return $this->model->paginate($paginetion);
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findCategoryById(int $id)
    {
        try{
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e){
            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Category|mixed
     */
   public function createCategory(array $params)
   {
       // TODO: Implement createCategory() method.

       try{
            $collection = collect($params);
            $status       = $collection->has('status') ? 1 : 0 ;

            $merge = $collection->merge(compact('status'));
            $category = new Category($merge->all());
            $category->save();
            return $category;

       }catch (QueryException $exception){
            throw  new InvalidArgumentException($exception->getMessage());
       }
   }


    /**
     * @param array $params
     * @return mixed
     */
   public function updateCategory(array $params)
   {
       // TODO: Implement updateCategory() method.

       $category = $this->findCategoryById($params['id']);

       $collection = collect($params)->except('_token');
       $status       = $collection->has('status') ? 1 : 0 ;

       $merge = $collection->merge(compact('status'));

       $category->update($merge->all());

       return $category;


   }

   public function deleteCategory(int $id)
   {
       // TODO: Implement deleteCategory() method.

       $category = $this->findCategoryById($id);

       if($category->image != null){
           $this->deleteOne($category->image);
       }

       $category->delete();

       return $category;
   }
}
