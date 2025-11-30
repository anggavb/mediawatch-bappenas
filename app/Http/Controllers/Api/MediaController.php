<?php

namespace App\Http\Controllers\Api;

use App\Models\Media\Media;
use App\Http\Controllers\Controller;
use App\Http\Requests\Media\StoreMediaRequest;
use App\Http\Requests\Media\UpdateMediaRequest;
use Illuminate\Support\Facades\Gate;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Media::with('category:id,name')->orderBy('order')->get();
        return response()->json($media);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaRequest $request)
    {
        $media = Media::create($request->validated());
        return response()->json($media, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMediaRequest $request, Media $medium)
    {
        $medium->update($request->validated());
        return response()->json($medium);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $medium)
    {
        Gate::authorize('delete', $medium);
        
        $medium->delete();
        return response()->json(null, 204);
    }
}
