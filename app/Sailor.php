<?php

namespace app;
use DB;
use Illuminate\Database\Eloquent\Model;

class Sailor extends Model
{
    protected $table="Sailors";
    public $timestamps = false;

    public function insert($sailor){

    	DB::table("Sailors")->insert([
    		"surname" => $sailor->surname,
	    	"name" => $sailor->name,
	    	"patronymic" => $sailor->patronymic,
	    	"birthDate" => $sailor->birthDate,
	    	"country" => $sailor->country,
	    	"region" => $sailor->region,
	    	"city" => $sailor->city,
	    	"region" => $sailor->region,
	    	"nationality" => $sailor->nationality,
	    	"permAdress" => $sailor->permAdress,
	    	"nearestAirport" => $sailor->nearestAirport,
	     	"contactPhone" => $sailor->contactPhone,
	    	"email" => $sailor->email,
	    	"password" => $sailor->password,	
    	]);
    }

    public static function update_sailor_data($sailor_data){
    	
    	DB::table("Sailors")->where('id',$sailor_data['id'])->update([
    		"country" => $sailor_data['country'],
	    	"city" => $sailor_data['city'],
	    	"region" => $sailor_data['region'],
	    	"permAdress" => $sailor_data['permAdress'],
	    	"nearestAirport" => $sailor_data['nearestAirport'],
	    	"contactPhone" => $sailor_data['contactPhone']	    		
    	]);

    }

    public static function checkAndGetUser($email,$password){

    	$user = static::where('email', $email)->first();
    	if($user && $user->password == $password){
    		return $user;
    	}
    	return null;
    }

    public static function getUserById($id){

        $user = static::where('id',$id)->first();
        return $user;        
    }

    public function resume(){
        return $this->hasOne('app\Resume', 'idSailor');
    }
}
