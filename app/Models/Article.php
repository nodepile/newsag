<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'category_id',
        'source_id',
        'author_id',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Get the category of this article.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the source of this article.
     */
    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    /**
     * Get the author of this article.
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
