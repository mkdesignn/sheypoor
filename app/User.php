<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
 	protected $table = "users";
 
 	protected $fillable = ['name' ,'family' ,'email' ,'username' ,'password' ,'type' ,'role_id' ,'sex' ,'avatar' ,'status' ,'remember_token' ]; 
 
 
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles(){
        return $this->hasMany("App\\Role", "id", "role_id");
    }

    public function meta(){
        return $this->hasOne(UserMeta::class, 'user_id', 'id');
    }

    /**
     * @param $query
     * @param $parameters
     * @param $value
     */
    public function scopeSearch($query, $parameters, $value){

        foreach( $parameters as $key => $parameter ){
            if( $key == 0 )
                $query->where($parameter[0], "LIKE", "%".$value."%");
            else
                $query->orWhere($parameter[0], "LIKE", "%".$value."%");

        }
    } 
 
  
 }