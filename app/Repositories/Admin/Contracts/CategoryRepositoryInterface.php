<?php
namespace App\Repositories\Admin\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function all(): Collection;

    public function create(array $data): void;

    public function findBySlug(string $slug);

    public function update(string $slug, array $data): void;

    public function delete(string $slug): void;
}
