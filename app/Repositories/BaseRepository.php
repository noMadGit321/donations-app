<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\BaseInterface;
use Illuminate\Support\Collection;


abstract class BaseRepository implements BaseInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $query = $this->model->where('id', $id)->first();
        return $query->update($data);
    }

    public function destroy(int $id)
    {
        $this->model->delete($id);
        return true;
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param Model $model
     */
    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

}
