<?php

namespace App\Http\RepositoryLayers;

use Illuminate\Database\Eloquent\Model;


class Repository{

    var $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->orderBy('created_at','desc')->get();
    }
    public function findBy($key,$value){
        return $this->model->where($key,$value)->get();
    }
    public function findById($id){
        return $this->model->findOrFail($id);
    }
    public function updateByAttribute(Model $instance, $attribute, $value)
    {
        $instance->$attribute = $value;
        return $instance->save();
    }
}
