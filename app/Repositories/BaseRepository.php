<?php

namespace App\Repositories;

use App\Exceptions\AppException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
  protected Model $model;

  public function __construct()
  {
    $this->makeModel();
  }

  abstract public function model();

  public function makeModel()
  {
    $model = app()->make($this->model());

    if (!$model instanceof Model) {
      throw new AppException(
        "Class {$this->model()} must be an instance of " . Model::class,
      );
    }

    return $this->model = $model;
  }

  public function all(): Collection
  {
    return $this->model->all();
  }

  public function find($keys)
  {
    return $this->model->find($keys);
  }

  public function findOrFail($keys)
  {
    return $this->model->findOrFail($keys);
  }

  public function firstOrNew(array $attributes, array $values = [])
  {
    return $this->model->firstOrNew($attributes, $values);
  }

  public function firstOrCreate(array $attributes, array $values = [])
  {
    return $this->model->firstOrCreate($attributes, $values);
  }

  public function delete(Model $model)
  {
    return $model->delete();
  }

  public function updateOrCreate(array $attributes, array $values = [])
  {
    return $this->model->updateOrCreate($attributes, $values);
  }
}
