<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{ 
 
 	protected $table = "roles";
 
 	protected $fillable = ['name' ,'value' ,'comment' ,'level' ]; 
 }