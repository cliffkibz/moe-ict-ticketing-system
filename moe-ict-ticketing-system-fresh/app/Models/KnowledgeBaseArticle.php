<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KnowledgeBaseArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'category', 'content', 'views', 'published'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title) . '-' . substr(Str::uuid(), 0, 8);
            }
        });
    }
}
