<?php

namespace App\Models\Medmon;

use App\Models\Media\Media;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = ['id'];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function content()
    {
        return $this->belongsTo(NewsContent::class);
    }
}
