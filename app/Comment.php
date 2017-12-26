<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{ 
 
 	protected $table = "comments";
 
 	protected $fillable = ['user_id' ,'name' ,'post_id' ,'parent_id' ,'title' ,'description' ,'email' ,'website' ,'ip' ,'status_id' ,'viewed' ]; 
 }