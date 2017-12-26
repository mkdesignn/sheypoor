<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motorbike extends Model
{
    use SoftDeletes;

    protected $table = "motorbikes";

    protected $fillable = ["name", "model", "cc", "weight", "color", "image", "price"];
}
