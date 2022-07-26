<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $perPage = 10;

    protected $casts = [
        'published_at' => 'datetime:Y-m-d',
    ];

    /**
     * Get the user that wrote the article.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the catagory of the article.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the comments for the article.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
