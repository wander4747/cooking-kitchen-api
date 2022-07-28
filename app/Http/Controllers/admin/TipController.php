<?php

declare(strict_types = 1);

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\TipRequest;
use App\Services\Admin\TipService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class TipController extends Controller
{
    public function __construct(protected TipService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }

    public function store(TipRequest $request): void
    {
        $this->service->store($request);
    }

    public function show($slug): JsonResponse|Collection
    {
        return $this->service->show($slug);
    }

    public function update(TipRequest $request, $slug): void
    {
        $this->service->update($request, $slug);
    }

    public function destroy($slug): JsonResponse
    {
        return $this->service->destroy($slug);
    }
}
