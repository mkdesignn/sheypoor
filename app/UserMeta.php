<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{ 
 
 	protected $table = "user_metas";
 
 	protected $fillable = ['user_id' ,'cell_number' ,'phone_number' ,'fax' ,'address' ,'website' ,'comment' ,'birth_date' ,'national_number' ,'id_number' ]; 
 }