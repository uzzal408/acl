<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Contracts\CategoryContract;

class CategoryController extends BaseController
{
    /**
     * @var
     */
    protected $categoryRepository;

    /**
     * CategoryController constructor.
     * @param CategoryContract $categoryRepository
     */
    public function __construct(CategoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->categoryRepository->listCategories('id','desc',['*'],10);

        $this->setPageTitle('Category','List of all categories');
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $categories = $this->categoryRepository->listCategories('id','asc');
        $this->setPageTitle('Category','Create Category');
        return view('admin.categories.create',compact('categories'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|max:191|unique:categories',
            'parent_id' => 'required|not_in:0',
            'image'     => 'mimes:jpg,jpeg,png|max:5000'
        ]);

        $params = $request->except('_token');

        $category = $this->categoryRepository->createCategory($params);

        if(!$category){
            return $this->responseRedirectBack('Error occurred while creating category','error',true,true);
        }

        return $this->responseRedirect('admin.categories.index','Category Added Successfully','success',false,false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetCategory = $this->categoryRepository->findCategoryById($id);
        $categories     = $this->categoryRepository->listCategories();

        $this->setPageTitle('Category','Edit Category : '.$targetCategory->name);
        return view('admin.categories.edit',compact('targetCategory','categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request){

        $this->validate($request,[
            'name' => 'required|max:191',
            'parent_id' => 'required|not_in:0',
            'image'     => 'mimes:jpg,jpeg,png|max:5000'
        ]);

        $params = $request->except('_token');
        $category = $this->categoryRepository->updateCategory($params);

        if(!$category){
            return $this->responseRedirectBack('Error occurred while updating category','error',true,true);
        }

        return $this->responseRedirectBack('Category updated successfully','success',false,false);
    }

    public function delete($id){
        $isParent = $this->categoryRepository->findCategoryById($id);
        $isParent = $isParent->parent_id;
        if($isParent!=1) {
            $category = $this->categoryRepository->deleteCategory($id);
        }else{
            $category = false;
        }
        if(!$category){
            return $this->responseRedirectBack('Error occurred while deleting category','error',true,true);
        }

        return $this->responseRedirect('admin.categories.index','Category deleted Successfully','success',false,false);
    }

}
