<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'file',
        'category_id',
        'downloads',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // accessors
    public function getRatingsCountAttribute()
    {
        return $this->ratings()->count() ?? 0;
    }

    public function getAverageRatingAttribute()
    {
        return number_format($this->ratings()->avg('rating') ?? 0, 1);
    }

    public function getImageUrlAttribute()
    {
        $basePath = 'storage';
        $photoPath = $this->image;
        return url("$basePath/$photoPath");
    }

    public function getFileUrlAttribute()
    {
        $basePath = 'storage';
        $filePath = $this->file;
        return url("$basePath/$filePath");
    }
}
