<?php

namespace App\Models\Medmon;

use App\Models\Media\Media;
use Illuminate\Database\Eloquent\Model;

class Medmon extends Model
{
    protected $guarded = ['id'];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function sentiment()
    {
        return $this->belongsTo(Sentiment::class);
    }

    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }
}
