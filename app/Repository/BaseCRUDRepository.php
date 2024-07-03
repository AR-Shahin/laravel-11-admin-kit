<?php
namespace App\Repository;
use Illuminate\Database\Eloquent\Model;

class BaseCRUDRepository{

    function __construct(private Model $model)
    {
    }

    function query() {
        return $this->model::query()->latest();
    }

    function all(){
        return $this->model::latest()->get();
    }

    function store($request) {
        return $this->model::create($request);
    }

    function show($id) {
        return $this->model::find($id);
    }

    function update($id,$request) {
        return $this->model::find($id)->update($request);
    }

    function delete($id,$relation = null) {

        return $this->model::find($id)->delete();
    }
}
