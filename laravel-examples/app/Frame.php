<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{

    protected $casts = [
        'colors' => 'array'
    ];

    protected $fillable = [
        "product_id",
        "name",
        "price",
        "image",
        "type",
        "colors",
        "size",
        "material",
        "shape",
        "spring_hinges",
        "eligible_progressive_bifocal",
        "gender",

    ];

}
