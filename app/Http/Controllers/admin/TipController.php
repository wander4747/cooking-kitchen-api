<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\TipRequest;
use Illuminate\Support\Str;
use Exception;
use App\Models\Tip;
use Illuminate\Support\Facades\Storage;

class TipController extends Controller
{

    public function index()
    {
        return Tip::all();
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

        $tip = Tip::create($data);

        if (!$tip) {
            return response()->json([ 'error' => 'Erro ao cadastrar dica!' ], 400);
        }

        return response()->json([ 'success' => 'A dica foi criada com sucesso!' ], 200);

        }

    public function show($slug)
    {
        $tip = Tip::where('slug', $slug)->get()->first();

        if (!$tip) {
            return response()->json(['error' => 'A dica não existe!'], 404);
        }

        return $tip;
    }

    public function update(TipRequest $request, $slug)
    {

        $tip = Tip::where('slug', $slug)->get()->first();

        if (!$tip) {
            return response()->json(['success' => 'Essa dica não existe!'], 404);
        }

        if ($request->gallery_directory) {
            $tip_image_directory = '/images/tips/' . Str::slug($request->title);
            $request->gallery_directory->store($tip_image_directory);
        }

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'gallery_directory' => '/images/tips/' . Str::slug($request->title),
            'category_uuid' => $request->category_uuid,
            'tip' => $request->tip,
        ];

        try {
            $tip->fill($data);
            Storage::deleteDirectory($tip->gallery_directory);
            $tip->save();
            return response()->json([ 'success' => 'A dica foi criada com sucesso!' ], 200);
        } catch (Exception) {
            return response()->json([ 'error' => 'Erro ao cadastrar dica!' ], 400);
        }
    }

    public function destroy($slug)
    {
        $tip = Tip::where('slug', $slug)->get()->first();

        if (!$tip) {
            return response()->json(['error' => 'A dica não existe!'], 404);
        }

        Storage::deleteDirectory($tip->gallery_directory);
        $tip->delete();

        return response()->json(['success' => 'A dica foi excluída com sucesso!'], 200);
    }
}
