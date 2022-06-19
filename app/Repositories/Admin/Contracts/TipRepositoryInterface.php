<?php

namespace App\Repositories\Admin\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface TipRepositoryInterface
{
    public function all(): Collection;

    public function create(array $data): void;

    public function findBySlug(string $slug): mixed;

    public function update(string $slug, array $data): void;

    public function delete(string $slug): void;
}
