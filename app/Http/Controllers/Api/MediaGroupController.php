<?php

namespace App\Http\Controllers\Api;

use App\Models\Media\MediaGroup;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\MediaGroup\StoreMediaGroupRequest;
use App\Http\Requests\MediaGroup\UpdateMediaGroupRequest;

class MediaGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', MediaGroup::class);

        $groups = MediaGroup::where('is_active', true)
            ->orderBy('order')
            ->get();
        return response()->json($groups);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaGroupRequest $request)
    {
        $form = $request->validated();
        $media = MediaGroup::create($form);
        return response()->json($media, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMediaGroupRequest $request, MediaGroup $media_group)
    {
        $media_group->update($request->validated());
        return response()->json($media_group);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MediaGroup $media_group)
    {
        Gate::authorize('delete', $media_group);

        if ($media_group->media()->count() > 0) {
            $media_group->is_active = false;
            $media_group->save();

            return response()->json(null, 204);
        }
        
        $media_group->delete();
        return response()->json(null, 204);
    }
}
