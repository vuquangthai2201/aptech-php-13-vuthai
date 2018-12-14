<?php

namespace App\Repositories;

abstract class EloquentRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function where($conditions, $operator = null, $value = null)
    {
        return $this->where($conditions, $operator, $value);
    }

    public function orWhere($conditions, $operator = null, $value = null)
    {
        return $this->orWhere($conditions, $operator, $value);
    }

    public function count($columns = '*')
    {
        return $this->model->count($columns);
    }

    public function first()
    {
        return $this->model->first();
    }

    public function get()
    {
        return $this->model->get();
    }

    public function pluck($column, $key = null)
    {
        return $this->model->pluck($column, $key);
    }

    public function paginate($limit)
    {
        $limit = is_null($limit) ? config('custom.paginate') : $limit;

        return $this->model->paginate($limit);
    }

    public function findOrFail($id, $columns = ['*'])
    {
        return $this->model->findorfail($id,$columns);
    }

    public function create(array $data = [])
    {
        return $this->model->insert($data);
    }

    public function update(array $data)
    {
        return $this->model->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
