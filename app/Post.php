<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class Post extends Model
{
    protected $guarded = [];

    public static function allPosts(){
        return app(Pipeline::class)
        ->send(Post::query())
        ->through([
            \App\QueryFilters\Active::class,
            \App\QueryFilters\Sort::class,
            \App\QueryFilters\MaxCount::class,
        ])
        ->thenReturn()->paginate(3);
    }
}
