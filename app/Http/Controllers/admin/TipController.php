<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\TipRequest;
use App\Repositories\Admin\Contracts\TipRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Exception;
use App\Models\Tip;
use Illuminate\Support\Facades\Storage;

class TipController extends Controller
{

    public function __construct(protected TipRepositoryInterface $model) {}

    public function index(): Collection
    {
        return $this->model->all();
    }

    public function store(TipRequest $request)
    {

        if ($request->gallery_directory) {
            $tip_image_directory = '/images/tips/' . Str::slug($request->title);
            $request->gallery_directory->store($tip_image_directory);
        }

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'gallery_directory' => '/images/tips/' . Str::slug($request->title),
            'category_uuid' => $request->category_uuid,
            'tipz' => $request->tip,
        ];

        $this->model->create($data);

        }

    public function show($slug)
    {
        try {
            return $this->model->findBySlug($slug);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Essa dica não existe!'], 404);
        }
    }

    public function update(TipRequest $request, $slug)
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

    public function destroy($slug)
    {
        try {
            $this->model->delete($slug);
            return response()->json(['success' => 'A dica foi excluída com sucesso!']);

        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Essa dica não existe!'], 404);
        }
    }
}
