<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CategoryRequest;
use App\Repositories\Admin\Contracts\CategoryRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function __construct(protected CategoryRepositoryInterface $model) {}

    public function index(): Collection
    {
        return $this->model->all();
    }

    public function store(CategoryRequest $request): JsonResponse
    {

//        if ($request->images) {
//            $category_image_directory = '/images/categories/' . Str::slug($request->title);
//            $request->images->store($category_image_directory);
//        }

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'gallery_directory' => '/images/categories/' . Str::slug($request->title),
            'is_active' => $request->is_active,
            'in_home' => $request->in_home,
        ];

        try {
            $this->model->create($data);
            return response()->json([ 'success' => 'A categoria foi criada com sucesso!' ]);
        } catch (Exception $error) {
            return response()->json([ 'error' => 'Erro ao cadastrar categoria!' ], 400);
        }
    }

    public function show(string $slug): Collection|JsonResponse
    {
        try {
            return $this->model->findBySlug($slug);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Essa categoria não existe!'], 404);
        }
    }

    public function update(CategoryRequest $request, string $slug): JsonResponse
    {
        try {
            $this->model->findBySlug($slug);

            if ($request->images) {
                $category_image_directory = '/images/categories/' . Str::slug($request->title);
                $request->images->store($category_image_directory);
            }

            $data = [
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'gallery_directory' => $request->images,
                'is_active' => $request->is_active,
                'in_home' => $request->in_home,
                'gallery_dir_name' => 'categories'
            ];

            $this->model->update($slug, $data);

            return response()->json(['success' => 'A categoria foi atualizada com sucesso!']);

        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Essa categoria não existe!'], 404);
        }
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
