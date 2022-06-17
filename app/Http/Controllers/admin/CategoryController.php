<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CategoryRequest;
use App\Models\Category;
use App\Repositories\Admin\Contracts\CategoryRepositoryInterface;
use Dflydev\DotAccessData\Data;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function __construct(protected CategoryRepositoryInterface $model)
    {
    }

    public function index(): Collection
    {
        return $this->model->all();
    }

    public function store(CategoryRequest $request): void
    {

        if ($request->gallery) {
            $category_image_directory = '/images/categories/' . Str::slug($request->title);
            $request->gallery->store($category_image_directory);
        }

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'gallery_directory' => '/images/categories/' . Str::slug($request->title),
            'is_active' => $request->is_active,
            'in_home' => $request->in_home,
        ];


        $this->model->create($data);
    }

    public function show(string $slug): Category|JsonResponse
    {
        try {
            return $this->model->findBySlug($slug);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Essa categoria não existe!'], 404);
        }
    }

    public function update(CategoryRequest $request, string $slug): JsonResponse
    {

            $model = $this->model->findBySlug($slug);

            if ($model->gallery_directory) {
                Storage::deleteDirectory($model->gallery_directory);
                $category_image_directory = '/images/categories/' . Str::slug($request->title);
                $request->gallery->store($category_image_directory);
            }

            $data = [
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'gallery_directory' => '/images/categories/' . Str::slug($request->title),
                'is_active' => $request->is_active,
                'in_home' => $request->in_home,
            ];

            $this->model->update($slug, $data);

            return response()->json(['success' => 'A categoria foi atualizada com sucesso!']);

    }

    public function destroy($slug): JsonResponse
    {
        try {
            $this->model->delete($slug);
            return response()->json(['success' => 'A categoria foi excluída com sucesso!']);

        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Essa categoria não existe!'], 404);
        }
    }
}
