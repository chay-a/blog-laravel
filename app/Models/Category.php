<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Get the category of the category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
