<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Articles extends Model
{
    const itemsPerPage = 5;
    const isUnPublished = 0;
    const isPublished = 1;

    protected $table = 'articles';

    protected $fillable = [
        'category_id',
        'title',
        'alias',
        'description',
        'short_description',
        'meta_description',
        'user_id',
        'is_published'
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', self::isPublished);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Categories');
    }

    public function comments()
    {
        return $this->hasMany('App\ArticlesComments', 'article_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tags');
    }
}
