<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        "title",
        "link",
        "image-src",
        "subreddit",
        "subreddit-link",
        "user",
        "user-link",
        "upvotes",
        "comment-count",
        "comment-link"
    ];

}
