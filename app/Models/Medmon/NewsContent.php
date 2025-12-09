<?php

namespace App\Models\Medmon;

use Illuminate\Database\Eloquent\Model;

class NewsContent extends Model
{
    protected $guarded = ['id'];

    public function news()
    {
        return $this->hasOne(News::class);
    }
}
