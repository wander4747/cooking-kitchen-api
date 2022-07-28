<?php

declare(strict_types = 1);

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CategoryRequest;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }

    public function store(CategoryRequest $request): void
    {
        $this->service->store($request);
    }

    public function show(string $slug): Category|JsonResponse
    {
        return $this->service->show($slug);
    }

    public function update(CategoryRequest $request, string $slug): void
    {
        $this->service->update($request, $slug);
    }

    public function destroy($slug): JsonResponse
    {
        return $this->service->destroy($slug);
    }
}
