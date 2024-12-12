<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Handle the article that belong to a given source.
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
