<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticlesComments extends Model
{
    protected $table = 'articles_comments';

    protected $fillable = ['username', 'comment', 'url', 'email', 'status'];

    public function article()
    {
        return $this->belongsTo('App\Articles');
    }
}
