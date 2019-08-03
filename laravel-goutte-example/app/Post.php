<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        "title",
        "link",
        "image_src",
        "subreddit",
        "subreddit_link",
        "user",
        "user_link",
        "upvotes",
        "comment_count",
        "comment_link"
    ];

}
