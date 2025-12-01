<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /** @use HasFactory<\Database\Factories\Media\MediaFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(MediaCategory::class, 'media_category_id');
    }

    public function group()
    {
        return $this->belongsTo(MediaGroup::class, 'media_group_id');
    }
}
