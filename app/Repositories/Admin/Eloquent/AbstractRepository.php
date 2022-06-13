<?php

namespace App\Repositories\Admin\Eloquent;

use App\Http\Requests\admin\CategoryRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

abstract class AbstractRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): void
    {
//        if ($data['gallery_directory']) {
//            $category_image_directory = "/images/{$data['gallery_dir_name']}/" . Str::slug($data['title']);
//            $data['gallery_directory']->store($category_image_directory);
//        }

        $this->model->create($data);
    }

    /**
     * @param string $slug
     */
    public function findBySlug(string $slug)
    {
        $model = $this->model
            ->where('slug', $slug)
            ->get()
            ->first();

        if (!$model) {
            throw new ModelNotFoundException();
        }

        return $model;
    }

    /**
     * @param string $slug
     * @param array $data
     * @return void
     */
    public function update(string $slug, array $data): void
    {
        $model = $this->model
            ->where('slug', $slug)
            ->get()
            ->first();

        if (!$model) {
            throw new ModelNotFoundException();
        }

        $model
            ->fill($data)
            ->save();
    }

    /**
     * @param string $slug
     * @return void
     */
    public function delete(string $slug): void
    {
        $model = $this->model
                    ->where('slug', $slug)
                    ->get()
                    ->first();

        if (!$model) {
            throw new ModelNotFoundException();
        }

        if ($model->gallery_directory) {
            Storage::deleteDirectory($model->gallery_directory);
        }

        $model->delete();
    }

    protected function resolveModel()
    {
        return app($this->model);
    }
}
