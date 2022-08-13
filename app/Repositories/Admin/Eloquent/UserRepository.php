<?php
namespace App\Repositories\Admin\Eloquent;

use App\Models\User;
use App\Repositories\Admin\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $model = User::class;

    public function updateUuid(string $uuid, array $data): void
    {
        $model = $this->model
            ->where('uuid', $uuid)
            ->get()
            ->first();

        if (!$model) {
            throw new ModelNotFoundException();
        }

        $model
            ->fill($data)
            ->save();
    }

    public function findByUuid(string $uuid)
    {
        $model = $this->model
            ->where('uuid', $uuid)
            ->get()
            ->first();

        if (!$model) {
            throw new ModelNotFoundException();
        }
        return $model;
    }

    public function deleteUuid(string $uuid): void
    {
        $model = $this->model
            ->where('uuid', $uuid)
            ->get()
            ->first();

        if (!$model) {
            throw new ModelNotFoundException();
        }

        $model->delete();
    }
}
