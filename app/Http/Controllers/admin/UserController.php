<?php

declare(strict_types = 1);

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UserRequest;
use App\Repositories\Admin\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function __construct(protected UserRepositoryInterface $model) {}

    public function index(): Collection
    {
        return $this->model->all();
    }

    public function store(UserRequest $request): void
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $this->model->create($data);
    }

    public function show($uuid): JsonResponse|Collection
    {
        try {
            return $this->model->findByUuid($uuid);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Essa categoria não existe!'], 404);
        }
        }

    public function update(UserRequest $request, $uuid): void
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $this->model->updateUuid($uuid, $data);
    }

    public function destroy($uuid): JsonResponse
    {
        try {
            $this->model->deleteUuid($uuid);
            return response()->json(['success' => 'A categoria foi excluída com sucesso!']);

        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Essa categoria não existe!'], 404);
        }
    }
}
