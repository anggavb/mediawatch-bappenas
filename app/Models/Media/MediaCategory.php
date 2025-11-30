<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaCategory extends Model
{
    /** @use HasFactory<\Database\Factories\Media\MediaCategoryFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function media()
    {
        return $this->hasMany(Media::class, 'media_category_id');
    }
}