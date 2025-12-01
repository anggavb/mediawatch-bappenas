<?php

namespace App\Http\Controllers\Api;

use App\Models\Media\Media;
use Illuminate\Http\Request;
use App\Models\Media\MediaGroup;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Media\StoreMediaRequest;
use App\Http\Requests\Media\UpdateMediaRequest;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Media::with(['category:id,name,order', 'group:id,name,order,is_active'])
            ->whereHas('group', function ($query) {
                $query->where('is_active', true);
            })
            ->get()
            ->sortBy(['group.order', 'category.order'])
            ->values();
        return response()->json($media);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaRequest $request)
    {
        $form = $request->validated();
        if ($form['media_group_id'] == null) {
            $group = MediaGroup::create([
                'name' => $form['name'],
                'is_active' => true,
            ]);
            
            $form['media_group_id'] = $group->id;
        }
        $media = Media::create($form);
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

    public function import(Request $request)
    {
        Gate::authorize('import', Media::class);

        Excel::import(new \App\Imports\MediaImport, $request->file('file'));
        return response()->json(['message' => 'Import successful'], 200);
    }
}
