<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseService
{
    public $repo;

    public function all(): Collection
    {
        return $this->repo->all();
    }

    public function create(array $data): Model
    {
        return $this->repo->create($data);
    }

    public function findById(int $id): Model
    {
        return $this->repo->findById($id);
    }

    public function update(int $id, array $data): bool
    {
        return $this->repo->update($id, $data);
    }

    public function destroy($id): bool
    {
        return $this->repo->destroy($id);
    }
}
