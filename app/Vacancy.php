<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $table = "Vacancies";
    public $timestamps = false;

    public function company(){
    	return $this->belongsTo('app\Company', 'idCompany');
    }

    public function role(){
    	return $this->belongsTo('app\Role', 'idRole');
    }

    public function englishLevel(){
    	return $this->belongsTo('app\EnglishLevel', 'idLevelOfEng');
    }

    public function vesselType(){
    	return $this->belongsTo('app\VesselType', 'idVesselType');
    }

    public function engineType(){
    	return $this->belongsTo('app\EngineType', 'idEngineType');
    }

}
