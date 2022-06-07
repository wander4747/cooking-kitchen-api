<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        return Category::all();
    }

    public function store(CategoryRequest $request)
    {

        if ($request->gallery_directory) {
            $category_image_directory = '/images/categories/' . Str::slug($request->title);
            $request->gallery_directory->store($category_image_directory);
        }

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'gallery_directory' => '/images/tips/' . Str::slug($request->title),
            'is_active' => $request->is_active,
            'in_home' => $request->in_home,
        ]; 

        try {
            Category::create($data);
            return response()->json([ 'success' => 'A categoria foi criada com sucesso!' ]);
        } catch (Exception $error) {
            return response()->json([ 'error' => 'Erro ao cadastrar categoria!' ]);
        }
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->get()->first();

        if (!$category) {
            return response()->json(['error' => 'A categoria não existe!']);
        }

        return $category;
    }

    public function update(CategoryRequest $request, $slug)
    {
        $category = Category::where('slug', $slug)->get()->first();

        if (!$category) {
            return response()->json(['error' => 'A categoria não existe.']);
        }

        if ($request->gallery_directory) {
            $category_image_directory = '/images/categories/' . Str::slug($request->title);
            $request->gallery_directory->store($category_image_directory);
        }

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'gallery_directory' => $request->gallery_directory,
            'is_active' => $request->is_active,
            'in_home' => $request->in_home
        ];

        try {
            $category->fill($data);
            Storage::deleteDirectory($category->gallery_directory);
            $category->save();
            return response()->json(['success' => 'A categoria foi editada com sucesso!']);
        } catch (Exception $error) {
            return response()->json([ 'error' => 'Erro ao editar categoria!' ]);
        }

    }

    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->get()->first();
        
        if (!$category) {
            return response()->json(['error' => 'A categoria não existe!']);
        }

        $category->delete();

        return response()->json(['success' => 'A categoria foi excluída com sucesso!']);
    }
}
