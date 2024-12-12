<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Handle the articles written by the given author.
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
