<?php

namespace App\Models\Medmon;

use App\Models\Media\Media;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $guarded = ['id'];

    public function medmons()
    {
        return $this->hasMany(Medmon::class);
    }
}
