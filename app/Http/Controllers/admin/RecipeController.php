<?php

declare(strict_types=1);
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\RecipeRequest;
use App\Services\Admin\RecipeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class RecipeController extends Controller
{
    public function __construct(protected RecipeService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }

    public function store(RecipeRequest $request): void
    {
        $this->service->store($request);
    }

    public function show($slug): JsonResponse|Collection
    {
        return $this->service->show($slug);
    }

    public function update(RecipeRequest $request, $slug): void
    {
        $this->service->update($request, $slug);
    }

    public function destroy($slug)
    {
        return $this->service->destroy($slug);
    }
}
