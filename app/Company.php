<?php

namespace app;
use DB;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = false;
    protected $table="Companies";

    public function insert($company){

    	DB::table($this->table)->insert([
	    	"name" => $company->name,
	    	"email" => $company->email,
            "fio" => $company->fio,
	    	"password" => $company->password,
	    	"site" => $company->site,
	    	"contactPhone" => $company->contactPhone,
    	]);
    }

    public static function checkAndGetUser($email,$password){

        $user = static::where('email', $email)->first();
        if($user && $user->password == $password){
            return $user;
        }
        return null;
    }

    public function vacancies(){
        return $this->hasMany('app\Vacancy', 'idCompany');
    }
}
