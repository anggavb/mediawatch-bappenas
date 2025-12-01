<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaGroup extends Model
{
    /** @use HasFactory<\Database\Factories\Media\MediaFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($media) {
            $media->order = self::max('order') + 1;
        });
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'media_group_id');
    }
}
