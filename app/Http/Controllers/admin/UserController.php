<?php

declare(strict_types=1);
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UserRequest;
use App\Services\Admin\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(protected UserService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }

    public function store(UserRequest $request): void
    {
        $this->service->store($request);
    }

    public function show($uuid): JsonResponse|Collection
    {
        return $this->service->show($uuid);
    }

    public function update(UserRequest $request, $uuid): void
    {
        $this->service->update($request, $uuid);
    }

    public function destroy($uuid): JsonResponse
    {
        return $this->service->destroy($uuid);
    }
}
