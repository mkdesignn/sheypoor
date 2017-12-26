<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{ 
 
 	protected $table = "files";
 
 	protected $fillable = ['name' ,'fileable_type' ,'fileable_id' ,'visibility' ]; 
 }