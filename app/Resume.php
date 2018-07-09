<?php

namespace app;
use DB;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{

	protected $table ="Resumes";
	public $timestamps = false;
    
    public function passports(){
    	return $this->hasMany('app\Passport', 'idResume');
    }

    public function certificates(){
    	return $this->hasMany('app\Certificate', 'idResume');
    }

    public function visas(){
    	return $this->hasMany('app\Visa', 'idResume');
    }

    public function experience(){
    	return $this->hasMany('app\Experience', 'idResume');
    }

    public function role(){
    	return $this->belongsTo('app\Role', 'idRole');
    }

    public function englishLevel(){
    	return $this->belongsTo('app\EnglishLevel', 'idLevelOfEng');
    }

    public function sailor(){
    	return $this->belongsTo('app\sailor', 'idSailor');
    }
}
