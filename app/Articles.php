<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Articles extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'categories_id',
        'title',
        'alias',
        'description',
        'short_description',
        'meta_description',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tags');
    }
}
