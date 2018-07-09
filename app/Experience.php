<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table="Experience";
    public $timestamps = false;

    public function vesselType(){
    	return $this->belongsTo('app\VesselType', 'idVesselType');
    }

    public function engineType(){
    	return $this->belongsTo('app\EngineType', 'idEngineType');
    }

     public function resume(){
    	return $this->belongsTo('app\Resume', 'idResume');
    }
    
    public function role(){
        return $this->belongsTo('app\Role', 'idRole');
    }
}
