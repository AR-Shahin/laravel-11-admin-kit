<?php

namespace App\Repositories;

use App\Helper\Trait\RequestLoggerTrait;

use Illuminate\Database\Eloquent\Model;

class BaseCRUDRepository
{
    use RequestLoggerTrait;
    function __construct(private Model $model)
    {
    }

    function __get($name)
    {
        if($name == "table"){
            return $name = $this->model->getTable();
        }
    }
    function query(array $relations = []): \Illuminate\Database\Eloquent\Builder
    {
        return $this->model::query()->with($relations)->latest();
    }

    function paginate(array $columns = ["*"], array $relations = [], $perPage = 20)
    {
        try{
            return $this->model::query()->with($relations)->latest()->select($columns)->paginate($perPage);
        }catch(\Exception $e){
            $this->error("Something went wrong in $this->table " . $e->getMessage());
        }
    }

    function all(array $columns = ["*"],array $relations = []){
        return $this->model::with($relations)->latest()->get($columns);
    }

    function store($request) {
        try {
            return $this->model::create($request);
        }catch(\Exception $e){
            $this->error("Something went wrong in $this->table " . $e->getMessage());
            return false;
        }
    }

    function show($id,array $relations = []) {
        try {
            return $this->model::with($relations)->find($id);
        }catch(\Exception $e){
            $this->error("Something went wrong in $this->table " . $e->getMessage());
            return false;
        }
    }

    function update($id,$request) {
        try {
            $data = $this->model::find($id);

            if(!$data){
                return false;
            }
            return $data->update($request);
        }catch(\Exception $e){
            $this->error("Something went wrong in $this->table " . $e->getMessage());
            return false;
        }
    }

    function delete($id): bool
    {
        try {
            $model = $this->model::find($id);
            if($model){
                $model->delete();
                return true;
            }
            return false;
        }catch(\Exception $e){
            $this->error("Something went wrong in $this->table " . $e->getMessage());
            return false;
        }
    }
}
