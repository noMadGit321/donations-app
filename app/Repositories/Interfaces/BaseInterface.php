<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface BaseInterface
{
    public function all();

    public function create(array $data);

    public function update(int $id, array $data);

    public function destroy(int $id);

    public function findById(int $id);
}
