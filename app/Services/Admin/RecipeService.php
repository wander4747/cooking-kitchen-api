<?php

declare(strict_types=1);
namespace App\Services\Admin;

use App\Http\Requests\admin\RecipeRequest;
use App\Repositories\Admin\Contracts\RecipeRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RecipeService
{
    public function __construct(protected RecipeRepositoryInterface $model)
    {
    }

    public function index(): Collection
    {
        return $this->model->all();
    }

    public function store(RecipeRequest $request): void
    {
        if ($request->gallery) {
            $recipe_image_directory = '/images/recipes/' . Str::slug($request->title);
            $request->gallery->store($recipe_image_directory);
        }

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category_uuid' => $request->category_uuid,
            'gallery_directory' => '/images/recipes/' . Str::slug($request->title),
            'preparation_time' => $request->preparation_time,
            'difficulty' => $request->difficulty,
            'number_of_people_served' => $request->number_of_people_served,
            'ingredients' => $request->ingredients,
            'preparation_mode' => $request->preparation_mode,
            'is_active' => $request->is_active
        ];

        $this->model->create($data);
    }

    public function show($slug): JsonResponse|Collection
    {
        try {
            return $this->model->findBySlug($slug);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Essa categoria não existe!', 404]);
        }
    }

    public function update(RecipeRequest $request, $slug): void
    {
        $model = $this->model->findBySlug($slug);

        if ($request->gallery_directory) {
            Storage::deleteDirectory($model->gallery_directory);
            $recipe_image_directory = '/images/recipes/' . Str::slug($request->title);
            $request->gallery_directory->store($recipe_image_directory);
        }

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category_uuid' => $request->category_uuid,
            'gallery_directory' => '/images/recipes/' . Str::slug($request->title),
            'preparation_time' => $request->preparation_time,
            'difficulty' => $request->difficulty,
            'number_of_people_served' => $request->number_of_people_served,
            'ingredients' => $request->ingredients,
            'preparation_mode' => $request->preparation_mode,
            'is_active' => $request->is_active
        ];

        $this->model->update($slug, $data);
    }

    public function destroy($slug)
    {
        $model = $this->model->findBySlug($slug);

        try {
            $this->model->delete($slug);
            Storage::deleteDirectory($model->gallery_directory);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Essa receita não existe!'], 404);
        }
    }
}
