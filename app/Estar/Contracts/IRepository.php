<?php
namespace App\Estar\Contracts;

interface IRepository{

    /**
     * 获取指定列的全部数据,默认根据id正序排列
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function all($columns = ['*'], $orderBy = 'id', $sortBy = 'asc');

    /**
     * 获取指定关系表(relationships)的全部数据
     * @param array $withModels
     * @return mixed
     */
    public function allWithRelation(array $withModels);

    /**
     * 获取指定关系表(relationships)指定分页数的全部数据
     * @param array $withModels
     * @return mixed
     */
    public function allWithRelationPaginate(array $withModels,$per_page = 10);

    public function latest($column = ['*'], $orderBy = 'id', $sortBy = 'asc', $count = 1);

    public function paginate($perpage = 15,$columns = array('*'));

    public function count();

    public function countBy($column,$id);

    public function create(array $data);

    public function update(array $data,$id,$attr="id");

    public function delete($id);

    public function find($id,$columns = array('*'));

    public function findBy($attr,$value,$columns = array('*'));

    public function lists($column = 'id');



}


