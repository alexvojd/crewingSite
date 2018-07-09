<?php

namespace app;
use DB;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $table="Managers";
    public $timestamps = false;

    public static function checkAndGetUser($email,$password){

    	$user = static::where('email', $email)->first();
    	if($user && $user->password == $password){
    		return $user;
    	}
    	return null;
    }
}
