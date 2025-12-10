<?php

namespace App\Models\Medmon;

use App\Models\Media\Media;
use Illuminate\Database\Eloquent\Model;

class Sentiment extends Model
{
    protected $guarded = ['id'];

    public function medmon()
    {
        return $this->belongsTo(Medmon::class);
    }
}
