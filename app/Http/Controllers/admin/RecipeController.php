<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\RecipeRequest;
use Illuminate\Support\Str;
use App\Models\Recipe;
use Exception;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{

    public function index()
    {
        return Recipe::all();
    }

    public function store(RecipeRequest $request)
    {

        if ($request->gallery_directory) {
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

        try {
            Recipe::create($data);
            return response()->json([ 'success' => 'A receita foi criada com sucesso!' ], 200);
        } catch (Exception $error) {
            return response()->json([ 'error' => 'Erro ao cadastrar receita!' ], 400);
        }
    }

    public function show($slug)
    {
        $recipe = Recipe::where('slug', $slug)->get()->first();

        if (!$recipe) {
            return response()->json(['error' => 'A receita não existe!'], 404);
        }

        return $recipe;
    }

    public function update(RecipeRequest $request, $slug)
    {
        $recipe = Recipe::where('slug', $slug)->get()->first();

        if ($request->gallery_directory) {
            $recipe_image_directory = '/images/recipes/' . Str::slug($request->title);
            $request->gallery_directory->store($recipe_image_directory);
        }

        $input = [
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

        try {
            $recipe->fill($input);
            $recipe->save();
            return response()->json([ 'success' => 'A receita foi criada com sucesso!' ], 200);
        } catch (Exception $error) {
            return response()->json([ 'error' => 'Erro ao cadastrar receita!' ], 404);
        }
    }

    public function destroy($slug)
    {
        $recipe = Recipe::where('slug', $slug)->get()->first();
        
        if (!$recipe) {
            return response()->json(['error' => 'A receita não existe!'], 404);
        }

        Storage::deleteDirectory($recipe->gallery_directory);
        $recipe->delete();

        return response()->json(['success' => 'A receita foi excluída com sucesso!'], 200);
    }
}
