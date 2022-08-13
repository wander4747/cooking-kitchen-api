<?php

declare(strict_types=1);
namespace App\Services\Admin;

use App\Http\Requests\admin\TipRequest;
use App\Repositories\Admin\Contracts\TipRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TipService
{
    public function __construct(protected TipRepositoryInterface $model)
    {
    }

    public function index(): Collection
    {
        return $this->model->all();
    }

    public function store(TipRequest $request): void
    {
        if ($request->gallery) {
            $tip_image_directory = '/images/tips/' . Str::slug($request->title);
            $request->gallery->store($tip_image_directory);
        }

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'gallery_directory' => '/images/tips/' . Str::slug($request->title),
            'category_uuid' => $request->category_uuid,
            'tip' => $request->tip,
        ];

        $this->model->create($data);
    }

    public function show($slug): JsonResponse|Collection
    {
        try {
            return $this->model->findBySlug($slug);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Essa dica não existe!'], 404);
        }
    }

    public function update(TipRequest $request, $slug): void
    {
        $model = $this->model->findBySlug($slug);

        if ($request->gallery) {
            Storage::deleteDirectory($model->gallery_directory);
            $tip_image_directory = '/images/tips/' . Str::slug($request->title);
            $request->gallery->store($tip_image_directory);
        }

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'gallery_directory' => '/images/tips/' . Str::slug($request->title),
            'category_uuid' => $request->category_uuid,
            'tip' => $request->tip,
        ];

        $this->model->update($slug, $data);
    }

    public function destroy($slug): JsonResponse
    {
        try {
            $this->model->delete($slug);
            return response()->json(['success' => 'A dica foi excluída com sucesso!']);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Essa dica não existe!'], 404);
        }
    }
}
