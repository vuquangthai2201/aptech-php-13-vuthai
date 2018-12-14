<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function where($conditions, $operator = null, $value = null);

    public function orWhere($conditions, $operator = null, $value = null);

    public function count($columns = '*');

    public function first();

    public function get();

    public function pluck($column, $key = null);

    public function paginate($limit);

    public function findOrFail($id, $columns = ['*']);

    public function create(array $data = []);

    public function update(array $data);

    public function delete($id);
}
