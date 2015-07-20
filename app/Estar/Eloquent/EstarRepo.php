<?php

namespace App\Estar\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use App\Estar\Contracts\IRepository;

abstract class EstarRepo implements IRepository{

    private  $app;
    private $model;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract  function model();

    public function makeModel()
    {
        $model = $this->app->make($this->model());
        if(!$model instanceof Model)
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model;
    }

    /**获取指定列的全部数据,默认根据id正序排列
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function all($columns = ['*'], $orderBy = 'id', $sortBy = 'asc')
    {
        return $this->model->orderBy($orderBy,$sortBy)->get($columns);

    }

    public function allWithRelation(array $withModels)
    {
        return $this->model->with($withModels)->get();
    }

    public function allWithRelationPaginate(array $withModels,$per_page = 10)
    {
        return $this->model->with($withModels)->paginate($per_page);
    }

    public function latest($column = ['*'], $orderBy = 'id', $sortBy = 'asc', $count = 1)
    {
        return $this->model->orderBy($orderBy,$sortBy)->take($count)->get($column);
    }

    public function count()
    {
        return $this->model->count();
    }

    /**
     * 获取特定列的总数
     * @param  [type] $column [指定列名，如company_id]
     * @param  [type] $id   [指定列的id，也可以为其他关联形式]
     * @return [type]         [int]
     */
    public function countBy($column,$id)
    {
        return $this->model->where($column,'=',$id)->count();
    }

    public function paginate($perpage = 15,$columns = array('*'))
    {
        return $this->model->paginate($perpage,$columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id, $attr="id")
    {
        return $this->model->where($attr,'=',$id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->where('id','=',$id)->delete();
    }

    public function find($id,$columns = array('*'))
    {
        return $this->model->find($id,$columns);
    }

    public function findBy($attr,$value,$columns = array('*'))
    {
        return $this->model->where($attr,'=',$value)->first($columns);
    }

    public function lists($column = 'id')
    {
        return $this->model->lists($column);
    }

}
