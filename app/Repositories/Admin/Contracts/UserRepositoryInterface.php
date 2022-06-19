<?php

namespace App\Repositories\Admin\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;

    public function create(array $data): void;

    public function findByUuid(string $slug);

    public function updateUuid(string $uuid, array $data);

    public function deleteUuid(string $uuid): void;
}
